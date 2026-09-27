# Migración de Google Cloud Run → VPS Hetzner

Guía completa para mover el portfolio de Cloud Run a un VPS de Hetzner con Docker Compose + Caddy.

## Cambios respecto a Cloud Run

| Antes (Cloud Run)                   | Ahora (VPS)                              |
| ----------------------------------- | ---------------------------------------- |
| Imagen desplegada por artifact/CI   | Imagen de GHCR + `docker compose`        |
| Puerto 8080 gestionado por GCP      | Caddy como proxy con HTTPS automático    |
| Sin TLS (lo termina Google)         | Caddy emite cert. Let's Encrypt al vuelo |
| FS efímero (SQLite en imagen)       | Volúmenes persistentes `app-database`    |
| Despliegue manual (`gcloud run`)    | GitHub Actions → SSH → compose up        |

## 1. Provisionar el VPS (Hetzner, Ubuntu 24.04)

```bash
ssh root@TU_IP

# Actualizar e instalar Docker + Compose
apt update && apt -y upgrade
apt -y install ca-certificates curl gnupg
install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
echo "deb [arch=amd64 signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu noble stable" \
  > /etc/apt/sources.list.d/docker.list
apt update && apt -y install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Usuario no-root para deploy
adduser --disabled-password --gecos "" deploy
usermod -aG docker deploy
mkdir -p /opt/portfolio && chown deploy:deploy /opt/portfolio

# Firewall (ufw): solo SSH, HTTP y HTTPS
ufw allow OpenSSH && ufw allow 80/tcp && ufw allow 443/tcp
ufw --force enable
```

Hetzner Cloud incluye firewall a nivel de datacenter: configúralo también para 22/80/443.

## 2. DNS

Apunta `ikerzaphoz.dev` y `www.ikerzaphoz.dev` (registro `A` / `AAAA`) a la IP del VPS.
Propaga antes de arrancar Caddy (necesita resolver el dominio para pedir el certificado).

## 3. Configurar el repo en el VPS

```bash
# Copia a /opt/portfolio del VPS (scp/rsync o clona el repo y copia):
# - docker-compose.yml
# - docker/caddy/Caddyfile
# (.env.production ya va embebido en la imagen; el APP_KEY se inyecta vía compose .env)
```

Crea `/opt/portfolio/.env` (compose lee este fichero para sustituir variables):

```bash
cat > /opt/portfolio/.env <<'EOF'
APP_KEY=base64:PEGA_AQUI_LA_CLAVE_DEL_ENV_PRODUCTION
SITE_DOMAIN=ikerzaphoz.dev
EOF
chmod 600 /opt/portfolio/.env
```

> La APP_KEY actual está en `.env.production` del repo. Si prefieres una nueva:
> `docker compose run --rm app php artisan key:generate --show`
> ⚠️ Cambiarla invalida sesiones/cifrado previos.

## 4. Primer arranque

```bash
cd /opt/portfolio
docker compose pull app
docker compose up -d
docker compose logs -f app   # Ctrl+C para salir
curl -I https://ikerzaphoz.dev/up   # debe devolver 200
```

Caddy emitirá el certificado TLS automáticamente al primer arranque.
Si el certificado no llega: `docker compose logs caddy` (revisa propagación DNS y puertos 80/443 abiertos).

## 5. CI/CD: GitHub Actions → GHCR → SSH

### 5.1 Hacer el paquete público (o usar login)

Los paquetes GHCR heredan visibilidad del repo. Si el repo es privado, el VPS necesita login:

```bash
# En el VPS: login con un PAT clásico con scope read:packages
echo PAT | docker login ghcr.io -u ikerzaphoz --password-stdin
```

Si el repo es público (este lo es), no hace falta login.

### 5.2 Secrets del repo (Settings → Secrets and variables → Actions)

| Secret           | Valor                                                       |
| ---------------- | ----------------------------------------------------------- |
| `VPS_HOST`       | IP del VPS                                                   |
| `VPS_USER`       | `deploy` (usuario no-root con docker group)                  |
| `VPS_SSH_KEY`    | Clave privada ED25519 generada para el deploy (sin passphrase) |

Genera la clave en tu máquina y añade la pública al VPS:

```bash
ssh-keygen -t ed25519 -C "github-actions-deploy" -f ~/.ssh/gha_deploy -N ""
ssh-copy-id -i ~/.ssh/gha_deploy.pub deploy@TU_IP
```

### 5.3 Despliegue

Al hacer push a `main` (o manual `workflow_dispatch`):

1. Buildx construye la imagen y la sube a `ghcr.io/ikerzaphoz/portfolio:latest` + `:sha-xxxxxxx`
2. SSH al VPS: `cd /opt/portfolio && docker compose pull app && up -d --no-deps app`
3. Verificación: curl a `https://ikerzaphoz.dev/up` hasta 200.

Rollback fácil:

```bash
# En el VPS
docker compose down
# Edita docker-compose.yml: image: ghcr.io/ikerzaphoz/portfolio:sha-abc1234
docker compose up -d
```

## 6. Docker Compose

`docker-compose.yml` (en el repo) define:

- **app**: imagen GHCR, healthcheck en `/up`, volúmenes `app-database` y `app-storage`
- **caddy**: proxy 80/443 con HTTPS automático (Let's Encrypt) hacia `app:8080`

```bash
# Útil en el VPS
docker compose ps
docker compose logs -f app | grep -i error
docker compose exec app php artisan tinker
docker compose restart app
docker compose down          # NO borra volúmenes
docker compose down -v       # ⚠️ BORRA la base de datos
```

## 7. Backups de la base de datos (SQLite)

```bash
# Cron en el VPS: backup diario 4:00 con retención de 14 días en /opt/backups
0 4 * * * docker exec portfolio-app-1 sqlite3 /var/www/html/database/database.sqlite ".backup /tmp/db.sqlite" \
  && docker cp portfolio-app-1:/tmp/db.sqlite /opt/backups/db-$(date +\%F).sqlite \
  && find /opt/backups -name 'db-*.sqlite' -mtime +14 -delete
```

## 8. Monitoreo

- Healthcheck integrado: `docker inspect --format '{{.State.Health.Status}}' portfolio-app-1`
- Watchtower (opcional) para auto-updates: descomenta el servicio en `docker-compose.yml`, no recomendado en producción.
- Logs rotados a 10MB×3 por contenedor.

## 9. Accesos SSH

```bash
ssh deploy@TU_IP
sudo -e /opt/portfolio/.env   # (con deploy en sudoers) o login como root
```

## 10. Limpieza Cloud Run (después de verificar)

Cuando el VPS esté estable:

```bash
gcloud run services delete portfolio --region=europe-southwest1
gcloud artifacts repositories delete cloud-run-source-deploy --location=europe-southwest1
```

---

**Fuente de verdad de los ficheros**: todos viven en el repo; el VPS solo necesita `docker-compose.yml`, `.env` (tiny) y `docker/caddy/Caddyfile`.
