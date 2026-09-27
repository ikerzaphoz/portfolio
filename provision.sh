#!/usr/bin/env bash
# Provisioning inicial del VPS Hetzner para el portfolio (Ubuntu 24.04)
# Uso: curl -fsSL https://raw.githubusercontent.com/ikerzaphoz/portfolio/main/provision.sh | bash
set -euo pipefail

# ── Docker CE + Compose ──────────────────────────────────────────────────────
install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
echo "deb [arch=amd64 signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu noble stable" \
  > /etc/apt/sources.list.d/docker.list
apt-get update
DEBIAN_FRONTEND=noninteractive apt-get install -y \
  docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# ── Usuario deploy (no root, grupo docker) ───────────────────────────────────
if ! id -u deploy &>/dev/null; then
  adduser --disabled-password --gecos "" deploy
fi
usermod -aG docker deploy

# ── Clave pública de GitHub Actions (deploy only) ────────────────────────────
install -d -m 700 /home/deploy/.ssh
PUBKEY='ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIMlXFHFAQngigrS11nJbrV0nNY/4/uYGTiEBEfNune5L github-actions-deploy'
grep -qF "$PUBKEY" /home/deploy/.ssh/authorized_keys 2>/dev/null || echo "$PUBKEY" >> /home/deploy/.ssh/authorized_keys
chmod 600 /home/deploy/.ssh/authorized_keys
chown -R deploy:deploy /home/deploy/.ssh

# ── Directorio de la app ─────────────────────────────────────────────────────
install -d -o deploy -g deploy /opt/portfolio

# ── Firewall básico ──────────────────────────────────────────────────────────
command -v ufw >/dev/null || DEBIAN_FRONTEND=noninteractive apt-get install -y ufw
ufw allow OpenSSH
ufw allow 80/tcp
ufw allow 443/tcp
yes | ufw enable

echo
echo "=== Provisióning completado ==="
docker --version
docker compose version
su - deploy -c "whoami && id" 2>/dev/null || true
