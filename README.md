# Spark Deck

Spark Deck is a web application built with Laravel, Livewire, and Tailwind CSS that allows users to create, organize, and study flashcard decks. Registered users can create their own decks, add flashcards, upvote community decks, and track completed decks. Flashcards can also be shared across multiple decks, making it easy to reuse study material.

---

## Group Members

* Richard Duong (richie-duong)
* Andrew Tan (tan00139)
* Ralph Lubin (lubi0036)

---

## Features

* User registration and authentication
* Create, edit, and delete flashcard decks
* Create, edit, and delete flashcards
* Associate flashcards with multiple decks
* Browse public flashcard decks
* Upvote community decks
* Mark decks as completed
* Responsive user interface built with Tailwind CSS

---

## Tech Stack

* Laravel 13
* Livewire 4
* Tailwind CSS
* SQLite
* Laravel Breeze Authentication

---

## Project Setup

### 1. Clone the repository

```bash
git clone <repository-url>
cd CST8257-Spark-Deck
```

Replace `<repository-url>` with your GitHub repository URL.

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Create the environment file

**Windows**

```powershell
copy .env.example .env
```

**macOS / Linux**

```bash
cp .env.example .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Create the SQLite database

**Windows**

```powershell
New-Item database/database.sqlite -ItemType File
```

**macOS / Linux**

```bash
touch database/database.sqlite
```

### 7. Run the database migrations

```bash
php artisan migrate
```

### 8. Start the development servers

Start the Laravel development server:

```bash
php artisan serve
```

In a second terminal, start the Vite development server:

```bash
npm run dev
```

Visit the application:

```
http://127.0.0.1:8000
```

Or, if using Laravel Herd:

```
http://cst8257-spark-deck.test
```

---

## Git Workflow

### 1. Make sure your local `main` branch is up to date

```bash
git checkout main
git pull origin main
```

### 2. Create a feature branch

```bash
git checkout -b feature/<feature-name>
```

Example:

```bash
git checkout -b feature/deck-crud
```

### 3. Make your changes and commit them

```bash
git add .
git commit -m "Describe your changes"
```

### 4. Push your branch

```bash
git push origin feature/<feature-name>
```

### 5. Open a Pull Request

Create a Pull Request on GitHub to merge your feature branch into `main`.

### Keeping Your Branch Up to Date

If changes are merged into `main` while you're working:

```bash
git checkout main
git pull origin main
git checkout feature/<feature-name>
git merge main
```

Resolve any merge conflicts if necessary before continuing development.

---

## Project Structure

```
app/
├── Livewire/
├── Models/
├── Providers/

database/
├── factories/
├── migrations/
└── seeders/

resources/
├── css/
├── js/
└── views/

routes/
└── web.php
```

---

## Team

* Richard Duong
* Andrew Tan
* Ralph Lubin

---

## License

This project is licensed under the MIT License.
