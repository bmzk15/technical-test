# Image de base
FROM node:18.18.0-bullseye-slim

# Copie du code source dans le conteneur
WORKDIR /app
COPY project/front .

# Installation des dépendances Node.js
RUN yarn install
RUN yarn build

# Exposition du port 3000
EXPOSE 3000
# Commande de démarrage de l'application
CMD ["yarn", "start"]
