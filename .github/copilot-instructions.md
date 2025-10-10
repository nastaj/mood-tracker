# Mood Tracker - AI Coding Instructions

## Architecture Overview

This is a PHP-based mood tracking web application with a merchandise store component, designed to run on WAMP/XAMPP stack.

### Project Structure & Conventions

```
├── index.php              # Main entry point (currently empty - needs routing logic)
├── config/db.php          # PDO database connection (MySQL)
├── api/                   # REST API endpoints for AJAX calls
│   ├── *_mood.php         # CRUD operations for mood tracking
│   ├── get_quote.php      # Motivational quotes feature
│   └── merch/             # E-commerce API endpoints
├── auth/                  # Authentication pages
├── pages/                 # Main application pages
├── includes/              # Shared PHP components (headers, helpers, auth checks)
└── assets/                # Static resources (CSS, JS, images)
```

## Development Patterns

### Database Layer

- Use the existing `$pdo` connection from `config/db.php`
- Follow prepared statement pattern for all queries: `$pdo->prepare()` → `execute()`
- Error handling via PDO exceptions is already configured
- Database name: `mood_tracker`

### API Endpoints Pattern

- API files should return JSON responses
- Include proper HTTP headers: `header('Content-Type: application/json')`
- Follow RESTful conventions: GET for retrieval, POST for creation, PUT/PATCH for updates, DELETE for removal
- Include authentication checks by requiring `includes/auth.php`

### Page Structure Pattern

- Pages should include `includes/header.php` for consistent layout
- Use `includes/helpers.php` for shared utility functions
- Authentication-required pages should include `includes/auth.php`

### Frontend Integration

- `assets/js/main.js` should handle AJAX calls to API endpoints
- Use `assets/css/style.css` for consistent styling
- Images stored in `assets/img/` and `assets/js/img/`

## Key Features to Implement

### Core Mood Tracking

- Mood entry with scale (1-10), notes, and timestamps
- Mood history visualization and trends
- Daily/weekly/monthly mood reports

### Additional Features

- Motivational quotes system (`api/get_quote.php`)
- Merchandise store with checkout functionality
- User authentication and session management

## Development Environment

- Designed for WAMP64 stack on Windows
- Local development URL likely: `http://localhost/JakubProject/mood-tracker/`
- Database should be accessible via phpMyAdmin

## Implementation Notes

- Most files are currently scaffolded but empty - implement following the established patterns
- Start with database schema creation for users, moods, quotes, and merchandise tables
- Implement authentication system first as it's required by most features
- Focus on API-first development for better frontend flexibility
