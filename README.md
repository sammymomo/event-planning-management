# CommunityConnect

A community event planning and management platform built with Laravel 13. Supports five roles — community member, organizer, volunteer, admin, and sponsor — with event creation, registration, volunteer task management, sponsorship tracking, and in-app notifications.

---

## Prerequisites

Install the following before running the setup script:

| Tool | Version | Download |
|------|---------|----------|
| PHP | 8.3+ | https://www.php.net/downloads |
| Composer | latest | https://getcomposer.org/download |
| Node.js | 18+ | https://nodejs.org |
| MySQL | 8.0+ | https://dev.mysql.com/downloads/mysql |

> **Mac (Homebrew):** `brew install php composer node mysql`
>
> **Windows:** Use [XAMPP](https://www.apachefriends.org) for PHP + MySQL, then install Composer and Node separately.

---

## Setup

**1. Clone the repository**
```bash
git clone https://github.com/sammymomo/event-planning-management.git
cd event-planning-management
```

**2. Create the MySQL database**

Log into MySQL and create a database:
```sql
CREATE DATABASE communityconnect;
```

**3. Run the setup script**
```bash
bash setup.sh
```

The script will:
- Install PHP and JS dependencies
- Create your `.env` file
- Ask for your database name, username, and password
- Run all database migrations
- Build frontend assets

**4. Start the server**
```bash
php artisan serve
```

Open **http://localhost:8000** in your browser.

---

## Creating an Admin Account

Admin accounts cannot be self-registered. After signing up on the site, promote your account via the terminal:

```bash
php artisan tinker --execute="App\Models\User::where('email','your@email.com')->update(['role'=>'admin']);"
```

---

## User Roles

| Role | What they can do |
|------|-----------------|
| **Member** | Browse events, register, submit feedback |
| **Organizer** | Create and manage events, view attendees and feedback |
| **Volunteer** | Sign up for volunteer tasks, manage schedule |
| **Sponsor** | Submit sponsorships, view acknowledgments and reports |
| **Admin** | Approve events, manage users, view audit logs |

---

## Tech Stack

- **Backend:** Laravel 13, PHP 8.3
- **Database:** MySQL
- **Frontend:** Blade, Tailwind CSS v4, Alpine.js
- **Auth:** Laravel Breeze
