# Spark Deck Project Conventions

This document outlines the coding standards and development workflow for Spark Deck.

The goal is to keep the project consistent and easy to maintain throughout development.

---

# Tech Stack

- Laravel 13
- Livewire 4
- Laravel Breeze
- Tailwind CSS
- SQLite

Use Laravel's built-in features whenever possible.

---

# Git Workflow

Always branch from `main`.

Branch names should follow this format:

```
feature/create-deck
feature/manage-flashcards
feature/browse-decks
feature/upvote-system
bugfix/login-validation
```

Before starting work:

```bash
git checkout main
git pull origin main
git checkout -b feature/<feature-name>
```

Before opening a Pull Request:

```bash
git add .
git commit -m "Short descriptive message"
git push origin feature/<feature-name>
```

---

# Commit Messages

Good examples:

```
Add deck creation page

Implement flashcard CRUD

Add deck upvote functionality

Fix validation on deck form

Update navigation layout
```

Avoid messages like:

```
stuff

update

fixed things

asdf
```

---

# Naming Conventions

## Models

Use singular names.

```
User
Deck
Flashcard
```

---

## Database Tables

Use plural table names.

```
users
decks
flashcards
```

Pivot tables:

```
deck_flashcard
deck_votes
completed_decks
```

---

## Livewire Components

Use PascalCase.

Examples:

```
BrowseDecks

ViewDeck

MyDecks

CreateDeck

EditDeck

ManageFlashcards
```

---

## Blade Views

Use kebab-case.

Examples:

```
browse-decks.blade.php

view-deck.blade.php

create-deck.blade.php
```

---

## Variables

Use descriptive names.

Good:

```php
$deck

$flashcard

$currentUser

$completedDecks
```

Avoid:

```php
$d

$x

$data
```

---

# Eloquent Relationships

Always use relationships instead of manually joining tables when appropriate.

Examples:

```php
$deck->flashcards

$user->decks

$flashcard->decks

$deck->user
```

---

# Validation

Validate all user input.

Prefer Livewire validation.

Display validation errors below each field.

---

# Tailwind CSS

Use Tailwind utility classes.

Avoid inline CSS.

Keep layouts responsive.

Reuse styling where possible.

---

# Livewire

Keep components focused on one responsibility.

Examples:

```
BrowseDecks

CreateDeck

ManageFlashcards
```

Avoid creating one component that does everything.

---

# Project Structure

```
app/

    Livewire/

    Models/

database/

    migrations/

resources/

    views/

routes/

    web.php
```

Keep files organized according to Laravel conventions.

---

# General Guidelines

- Keep methods short and readable.
- Prefer Eloquent over raw SQL.
- Follow Laravel naming conventions.
- Remove unused code before committing.
- Don't duplicate logic.
- Test new features before pushing.

---

# Team Expectations

Before pushing code:

- Run the application.
- Verify there are no PHP errors.
- Verify Livewire components work correctly.
- Make sure migrations run successfully.
- Pull the latest changes from `main` if needed.

When unsure, ask the team before introducing a new library, package, or architectural pattern.

The goal is consistency, simplicity, and maintainability.