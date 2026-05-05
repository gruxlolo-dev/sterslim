#!/bin/bash

# Colors
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}🚀 Welcome to Sterslim v1.0.0 Installer${NC}"

# Project Name
read -p "Enter Project Name [my-app]: " APP_NAME
APP_NAME=${APP_NAME:-my-app}

# Database Type
echo "Select Database Type:"
echo "1) MySQL"
echo "2) MariaDB"
echo "3) PostgreSQL"
echo "4) MongoDB"
read -p "Choice [1-4]: " DB_CHOICE

case $DB_CHOICE in
    2) DB_TYPE="mariadb"; DB_IMAGE="mariadb:latest"; DB_PORT=3306 ;;
    3) DB_TYPE="pgsql"; DB_IMAGE="postgres:latest"; DB_PORT=5432 ;;
    4) DB_TYPE="mongodb"; DB_IMAGE="mongo:latest"; DB_PORT=27017 ;;
    *) DB_TYPE="mysql"; DB_IMAGE="mysql:8.0"; DB_PORT=3306 ;;
esac

read -p "Database Name [sterslim]: " DB_NAME
DB_NAME=${DB_NAME:-sterslim}
read -p "Database User [user]: " DB_USER
DB_USER=${DB_USER:-user}
read -p "Database Password [secret]: " DB_PASS
DB_PASS=${DB_PASS:-secret}

# Generate .env
echo "Generating .env..."
cat <<EOF > .env
APP_NAME=$APP_NAME
APP_ENV=local

DB_TYPE=$DB_TYPE
DB_HOST=db
DB_PORT=$DB_PORT
DB_NAME=$DB_NAME
DB_USER=$DB_USER
DB_PASS=$DB_PASS
EOF

if [ "$DB_TYPE" == "mongodb" ]; then
    echo "Installing MongoDB library..."
    composer require mongodb/mongodb --ignore-platform-reqs --quiet
fi

# Generate docker-compose.yml
echo "Generating docker-compose.yml..."
cat <<EOF > docker-compose.yml
version: '3.8'

services:
  app:
    build: 
      context: .
      dockerfile: .docker/Dockerfile
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
    environment:
      - APP_NAME=$APP_NAME
    depends_on:
      - db

  db:
    image: $DB_IMAGE
    ports:
      - "$DB_PORT:$DB_PORT"
    environment:
      MYSQL_DATABASE: $DB_NAME
      MYSQL_USER: $DB_USER
      MYSQL_PASSWORD: $DB_PASS
      MYSQL_ROOT_PASSWORD: root
      POSTGRES_DB: $DB_NAME
      POSTGRES_USER: $DB_USER
      POSTGRES_PASSWORD: $DB_PASS
      MONGO_INITDB_DATABASE: $DB_NAME
    volumes:
      - db_data:/var/lib/mysql
      - db_data_pgsql:/var/lib/postgresql/data
      - db_data_mongo:/data/db

volumes:
  db_data:
  db_data_pgsql:
  db_data_mongo:
EOF

echo -e "${GREEN}✅ Configuration complete!${NC}"
echo -e "Run ${BLUE}docker-compose up -d${NC} to start your project."
echo -e "Your app will be available at ${BLUE}http://localhost:8080${NC}"
