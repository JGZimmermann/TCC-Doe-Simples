#!/bin/sh

# Copia os certificados do volume montado para um diretório interno
cp -L -r /etc/letsencrypt /tmp/

# Executa o comando original do Nginx para iniciar o servidor
exec nginx -g 'daemon off;'
