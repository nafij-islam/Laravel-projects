# Laravel Todo App

Simple Todo Application built with Laravel, Blade, MySQL, and Tailwind CSS.

## Features
- Add, Edit, Delete todos with confirmation
- Mark complete/incomplete
- Attach files (JPG, PNG, PDF up to 2MB)
- Due dates with overdue notification
- Clean Tailwind UI

## Setup Instructions

1. Clone the repository:
```bash
git clone https://github.com/nafij-islam/Laravel-projects.git
cd Laravel-projects
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Setup Database:
- Make sure MySQL is running on `127.0.0.1:3306`.
- Create database `todo_app` (or configure in `.env`).

4. Run migrations & link storage:
```bash
php artisan migrate
php artisan storage:link
```

5. Run the application:
```bash
composer run dev
```
Visit `http://127.0.0.1:8000` in your browser.
