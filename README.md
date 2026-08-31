# WFC-ards

A PHP web application with flashcards for learning. Create folders, add your own flashcards, and study them with an interactive interface.

## Features

- Create flashcard folders to organize your learning material
- Login and registration system with hashed passwords
- Add, view, and delete flashcards within a folder
- Select a flashcards folder and study with an interactive flip animation
- Navigate between flashcards with Next/Previous
- All data saved in a MySQL/MariaDB database

## How to run

### Pre-built Docker image (recommended)

```bash
docker pull ghcr.io/nahida4479/wfc-ards:latest
docker run -d -p 8000:8000 ghcr.io/nahida4479/wfc-ards:latest
```

Then open [http://localhost:8000](http://localhost:8000) in your browser.

### Option 2: Build the Docker image yourself

```bash
git clone https://github.com/nahida4479/wfc-ards.git
cd wfc-ards
docker build -t wfc-ards .
docker run -d -p 8000:8000 wfc-ards
```

### Option 3: Run without Docker

Requirements: `PHP 8+`, `MySQL/MariaDB`, `php-mysqli`.

1. Clone the repository:
```bash
   git clone https://github.com/Nahida4479/WFC-ards.git
   cd WFC-ards
```
2. Create the database and import the schema:
```bash
   mysql -u root -p -e "CREATE DATABASE flashcards_app;"
   mysql -u root -p flashcards_app < database/schema.sql
```
3. Copy the config template and fill in your database credentials:
```bash
   cp public/config.example.php public/config.php
```
4. Start PHP server:
```bash
   php -S 0.0.0.0:8000 -t public
```
5. Open [http://localhost:8000](http://localhost:8000) in your browser.

