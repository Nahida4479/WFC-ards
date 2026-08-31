#!/bin/bash
set -e

service mariadb start

until mysqladmin ping --silent; do
    sleep 1
done

mysql -e "CREATE DATABASE IF NOT EXISTS flashcards_app;"
mysql -e "CREATE USER IF NOT EXISTS 'flashcards_user'@'localhost' INDETIFIED by 'ubuntu';"
mysql -e "GRANT ALL PRIVILEGES ON flashcards_app.* TO 'flashcards_user'@'localhost';"
mysql -e  "FLUSH PRIVILEGES;"

mysql flashcards_app < /WFC-ards/database/schema.sql

php -S 0.0.0.0:8000 -t /WFC-ards/public