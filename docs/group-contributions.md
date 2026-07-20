# Spark Deck - Task Distribution

## Team Members

- Richard Duong
- Andrew Tan
- Ralph Lubin

---

# Project Foundation (Completed)

**Completed by Richard**

- [x] Initialize Laravel 13 project
- [x] Install Livewire 4
- [x] Install Laravel Breeze
- [x] Configure Tailwind CSS
- [x] Configure SQLite
- [x] Create database schema
- [x] Create migrations
- [x] Create Eloquent models
- [x] Configure model relationships
- [x] Create README
- [x] Create GitHub Copilot instructions
- [x] Create project conventions
- [x] Configure Git repository

---

# Richard — Browse & Discover

## Pages / Livewire Components

- [ ] Home Page
- [ ] Browse Decks
- [ ] View Deck

## Features

- [ ] Display all public decks
- [ ] View deck details
- [ ] Display flashcards within a deck
- [ ] Display deck creator
- [ ] Upvote a deck
- [ ] Show total upvotes

## Database

Uses:

- decks
- flashcards
- deck_votes

---

# Andrew — Deck Management

## Pages / Livewire Components

- [ ] My Decks
- [ ] Create Deck
- [ ] Edit Deck

## Features

- [ ] Display user's decks
- [ ] Create new deck
- [ ] Edit deck
- [ ] Delete deck
- [ ] Form validation
- [ ] Success/error messages

## Database

Uses:

- decks

---

# Ralph — Flashcards & Studying

## Pages / Livewire Components

- [ ] Manage Flashcards
- [ ] Study Deck

## Features

- [ ] Create flashcards
- [ ] Edit flashcards
- [ ] Delete flashcards
- [ ] Add flashcards to deck
- [ ] Remove flashcards from deck
- [ ] Navigate between flashcards
- [ ] Mark deck as completed

## Database

Uses:

- flashcards
- deck_flashcard
- completed_decks

---

# Shared Tasks

Everyone contributes to:

- [ ] Responsive styling
- [ ] Testing
- [ ] Bug fixes
- [ ] Final polish
- [ ] Code reviews
- [ ] Merge Pull Requests

---

# Git Workflow

Before starting work:

```bash
git checkout main
git pull origin main
git checkout -b feature/<feature-name>
```

Examples:

```
feature/browse-decks
feature/create-deck
feature/manage-flashcards
```

Commit changes:

```bash
git add .
git commit -m "Implement browse decks page"
git push origin feature/<feature-name>
```

Open a Pull Request into `main`.

---

# Project Milestones

## Milestone 1 ✅

- Laravel setup
- Livewire
- Breeze
- Database
- Models
- Documentation

---

## Milestone 2

Create all Livewire components and Blade pages.

No functionality yet.

---

## Milestone 3

Implement CRUD functionality.

---

## Milestone 4

Connect all features together.

---

## Milestone 5

Testing and final polish.

---

# Development Guidelines

- Keep solutions simple.
- Stay within concepts covered in class.
- Follow Laravel conventions.
- Use Livewire instead of unnecessary JavaScript.
- Use Eloquent relationships instead of raw SQL.
- Validate all user input.
- Ask the team before adding new packages or libraries.

Our goal is to build a clean, functional application that demonstrates the Laravel concepts we've learned—not to over-engineer the project.