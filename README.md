# Aurora — Personal Task Manager (Laravel Mini Project)

-**Project Code:** WST21-PM-2026-SF
- **Student Name:** GARY BENZ VICTOR LIM
- **Course & Year:** BSIT 2
- **Database Used:** MySQL

## Features
- Add Task
- <img width="1920" height="1080" alt="add-task-form" src="https://github.com/user-attachments/assets/9b62e135-ae7f-48d1-9527-6a373867d742" />


- View Tasks
- <img width="1920" height="1080" alt="view-tasks" src="https://github.com/user-attachments/assets/35e2c7aa-3f22-4c86-89f5-43899633a547" />


- Edit Task
- <img width="1920" height="1080" alt="edit-task-form" src="https://github.com/user-attachments/assets/ccd276f3-8849-45bc-818a-b6488b8a5e17" />
- <img width="1920" height="1080" alt="edit-task-changed" src="https://github.com/user-attachments/assets/296b4e8e-eaa3-46a5-af30-cf650ce68e82" />
- 


- Delete Task
- <img width="1920" height="1080" alt="delete-confirm" src="https://github.com/user-attachments/assets/cd2b8f68-89d9-4b30-9bc7-9718613b1947" />
- <img width="1920" height="1080" alt="delete-result" src="https://github.com/user-attachments/assets/fb7b4e9c-1b5c-4c69-99e1-b97b42858da9" />


- Update Status (Pending / Completed, with a one-click toggle)
- <img width="1920" height="1080" alt="update-status" src="https://github.com/user-attachments/assets/e0295c7b-908a-473b-8806-11b0e0758481" />



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
