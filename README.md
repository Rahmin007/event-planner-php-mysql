# Event Planner Dashboard

A full-stack web application for collaborative event planning. Supports two roles — Planner and Participant — with separate dashboards, timetable management, budget tracking, notes, and participant coordination.

## Features

- **Authentication** — Signup and login with role-based session management (Planner / Participant)
- **Plan management** — Create and manage multiple event plans
- **Timetable** — Insert, edit, and delete scheduled activities with date, time, and location
- **Budget tracking** — Add budget entries and track spending per plan
- **Participant management** — Add and view participants per event
- **Notes** — Add notes to any plan
- **Role-based UI** — Planners see edit/delete controls; participants see read-only views

## Tech Stack

- **Backend** — PHP
- **Database** — MySQL
- **Frontend** — HTML, CSS (vanilla)

## Project Structure

```
event-planner-php-mysql/
├── index.php                   # Timetable view
├── login.html / login_process.php
├── signup_form.html / signup_process.php
├── planner_dashboard.php       # Planner home
├── plan_dashboard.php          # Per-plan overview
├── create_plan.html / create_plan_process.php
├── budget.php / edit_budget.php / update_spent.php
├── notes.php / add_notes.php
├── participant_info.php / add_participant.php
├── time_table_input.html / time_table_insertion.php
├── mrc_edit_table.php / mrc_edit_form.php / mrc_update_entry.php
├── database_connection.php     # DB config (configure before use)
└── styles.css
```

## Setup

1. Import the database schema into MySQL (create a database named `370project` or update `database_connection.php`).
2. Configure `database_connection.php` with your local MySQL credentials.
3. Serve with XAMPP, WAMP, or any PHP/MySQL stack.
4. Open `login.html` in your browser to get started.

## Course

CSE370 — Database Systems / Web Development, BRACU (2023)
