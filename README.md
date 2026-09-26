# Aurora — Personal Task Manager (Laravel Mini Project)

Project Code: WST21-PM-2026-SF
Student Name:GARY BENZ VICTOR LIM
Course & Year:BSIT 2
Database Used: MySQL 

## Features
- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status (Pending / Completed, with a one-click toggle)


---

## How these files fit into a fresh Laravel project

These are the files you add on top of a new Laravel install — not a full project export (no vendor/, no node_modules/, no .env with real credentials).

### 1. Create a new Laravel project
```bash
composer create-project laravel/laravel task-manager
cd task-manager
```

### 2. Copy in these files
Copy each file from this package into the matching path in your new project, overwriting where needed:
```
app/Models/Task.php
app/Http/Controllers/TaskController.php
routes/web.php
database/migrations/2026_01_01_000000_create_tasks_table.php
resources/views/layouts/app.blade.php
resources/views/tasks/index.blade.php
resources/views/tasks/create.blade.php
resources/views/tasks/edit.blade.php
```

### 3. Configure your database
Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```
Create the `task_manager` database in MySQL (e.g. via phpMyAdmin or `CREATE DATABASE task_manager;`).

### 4. Run the migration
```bash
php artisan migrate
```

### 5. Serve the app
```bash
php artisan serve
```
Visit `http://127.0.0.1:8000` — it redirects straight to the task board.

---

## App structure
- **Route → Controller → Model → Database → Blade**, exactly as required:
  - `routes/web.php` defines a resource route for `tasks` plus one extra `PATCH` route to toggle status.
  - `TaskController` handles all CRUD logic and validation.
  - `Task` is the Eloquent model (`app/Models/Task.php`), with an `isOverdue()` helper used in the view.
  - The `tasks` migration creates the table with `id`, `task_name`, `description`, `status`, `due_date`, plus timestamps.
  - Three Blade views (`index`, `create`, `edit`) extend a shared `layouts/app.blade.php` that holds the Aurora theme.

## Notes
- Status is toggled either from the edit form or the round checkbox button next to each task on the board.
- The board has filter tabs (All / Pending / Completed) and live counts at the top.
- Feel free to add screenshots here before submitting, per the assignment instructions.
