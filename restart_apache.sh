#!/bin/bash

# Configuration
LOW_SECURITY_SITE="low_security.conf"
MEDIUM_SECURITY_SITE="medium_security.conf"
IMPOSSIBLE_SECURITY_SITE="impossible_security.conf"
APACHE_SERVICE="apache2"

# Fonction pour redémarrer le serveur Apache
restart_apache() {
  echo "Redémarrage du serveur Apache..."
  sudo service $APACHE_SERVICE restart
}

# Activer le site Apache en fonction du niveau de sécurité
activate_site() {
  if [[ "$SECURITY_LEVEL" == "low" ]]; then
    sudo a2dissite $MEDIUM_SECURITY_SITE $IMPOSSIBLE_SECURITY_SITE
    sudo a2ensite $LOW_SECURITY_SITE
  elif [[ "$SECURITY_LEVEL" == "medium" ]]; then
    sudo a2dissite $LOW_SECURITY_SITE $IMPOSSIBLE_SECURITY_SITE
    sudo a2ensite $MEDIUM_SECURITY_SITE
  elif [[ "$SECURITY_LEVEL" == "impossible" ]]; then
    sudo a2dissite $LOW_SECURITY_SITE $MEDIUM_SECURITY_SITE
    sudo a2ensite $IMPOSSIBLE_SECURITY_SITE
  else
    echo "Niveau de sécurité non reconnu : $SECURITY_LEVEL"
    exit 1
  fi
}

# Appliquer la nouvelle configuration Apache
activate_site

# Redémarrer le serveur Apache
restart_apache
