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
* Livewire 3
* FLUX UI
* Tailwind CSS
* SQLite
* Laravel Breeze Authentication

---

## Requirements

- PHP 8.4+
- Composer
- Node.js 22+
- npm
- Git

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
php artisan migrate --seed
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

To avoid merge conflicts, **do not work directly on the `main` branch**. Each team member should create their own feature branch for the feature they are working on.

### 1. Update your local `main` branch

Before starting any work, make sure your local `main` branch is up to date.

```bash
git checkout main
git pull origin main
```

### 2. Create a feature branch

Create a new branch from `main` for the feature you are working on.

```bash
git checkout -b feature/<feature-name>
```

Examples:

```bash
git checkout -b feature/deck-crud
git checkout -b feature/flashcard-crud
git checkout -b feature/study-mode
```

### 3. Work on your feature

Make changes only on your feature branch. Commit your work regularly.

```bash
git add .
git commit -m "Implement deck creation"
```

### 4. Push your branch

Push your feature branch to GitHub.

```bash
git push -u origin feature/<feature-name>
```

The `-u` option only needs to be used the first time you push the branch.

### 5. Create a Pull Request

When your feature is complete:

- Push your latest commits.
- Open a Pull Request on GitHub.
- Request another team member to review your changes.
- Merge the Pull Request into `main` after it has been reviewed.

### Keeping Your Branch Up to Date

If new changes have been merged into `main` while you're still working:

```bash
git checkout main
git pull origin main

git checkout feature/<feature-name>
git merge main
```

Resolve any merge conflicts before continuing development.

> **Important:** Never commit directly to the `main` branch. All new features and bug fixes should be developed on a separate feature branch and merged into `main` through a Pull Request.

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
