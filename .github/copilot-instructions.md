# Spark Deck - GitHub Copilot Instructions

## Project Overview

Spark Deck is a flashcard web application built as a college group project using Laravel 13, Livewire 4, Tailwind CSS, Laravel Breeze, and SQLite.

The objective is to practice Laravel fundamentals while following the concepts covered in class.

---

# Tech Stack

- Laravel 13
- Livewire 4
- Laravel Breeze
- Tailwind CSS
- SQLite
- PHP 8.4+

---

# Development Philosophy

Keep solutions simple, readable, and beginner-friendly.

Favor Laravel conventions over custom architectures.

Assume this project will be graded by instructors expecting standard Laravel code.

---

# Use

Prefer:

- Eloquent Models
- Eloquent Relationships
- Livewire Components
- Blade Templates
- Route Model Binding
- Form Validation
- Laravel Authentication
- Tailwind CSS utilities
- RESTful resource conventions where appropriate

---

# Avoid

Do NOT introduce technologies or architectures that are outside the scope of this course unless specifically requested.

Avoid suggesting:

- Repository Pattern
- Service Layer
- DTOs
- View Models
- Action Classes
- Filament
- Volt
- Inertia
- Vue
- React
- Alpine plugins
- Third-party admin panels
- Spatie packages
- Complex design patterns
- Microservices
- Event sourcing

Keep the application using standard Laravel practices.

---

# Database

Current tables:

- users
- decks
- flashcards
- deck_flashcard
- deck_votes
- completed_decks

Relationships:

User

- hasMany Decks
- hasMany Flashcards
- belongsToMany Upvoted Decks
- belongsToMany Completed Decks

Deck

- belongsTo User
- belongsToMany Flashcards
- belongsToMany Voters
- belongsToMany Completed Users

Flashcard

- belongsTo User
- belongsToMany Decks

---

# Livewire Guidelines

Prefer Livewire components instead of controllers whenever appropriate.

Use:

- public properties
- computed properties
- validation
- actions
- events

Keep component logic straightforward.

Avoid excessive abstraction.

---

# Code Style

Generate code that:

- follows PSR-12
- uses descriptive variable names
- is easy for students to understand
- includes comments only when they improve clarity
- follows Laravel naming conventions

Do not over-engineer solutions.

---

# UI Guidelines

Use Tailwind CSS only.

Keep layouts simple.

Prefer Laravel Breeze styling where possible.

Avoid introducing custom JavaScript unless necessary.

---

# Authentication

Use Laravel Breeze authentication.

Use:

- auth()
- Auth::user()
- @auth
- @guest

Do not implement custom authentication systems.

---

# Validation

Prefer Laravel validation using Livewire validation rules.

Display validation errors using Blade.

---

# Responses

When generating code:

- explain the reasoning briefly
- keep examples concise
- prefer readability over cleverness
- generate production-quality but beginner-friendly code

Assume the audience is a second-year web development student.