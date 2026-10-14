#!/bin/sh
set -e

# msmtp-Konfiguration aus Umgebungsvariablen erzeugen (Passwort nicht im Image)
cat > /etc/msmtprc <<EOF
defaults
auth           on
tls            on
tls_trust_file /etc/ssl/certs/ca-certificates.crt
logfile        /tmp/msmtp.log

account        default
host           ${SMTP_HOST:-mail.gmx.net}
port           ${SMTP_PORT:-587}
tls_starttls   on
from           ${SMTP_USER}
user           ${SMTP_USER}
password       ${SMTP_PASS}
EOF

chown www-data:www-data /etc/msmtprc
chmod 600 /etc/msmtprc

exec docker-php-entrypoint "$@"
