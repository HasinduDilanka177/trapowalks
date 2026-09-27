# TrapoWalks — Interactive Travel Web Application

**ICT 2209 – Web Technologies | Mini Project**

TrapoWalks is a fully responsive travel web application for planning and exploring walking
tours across Sri Lanka. It features a dynamic frontend (HTML5, CSS3, Bootstrap 5, vanilla
JavaScript) and a complete PHP + MySQL backend with user authentication, a contact form,
and a personal travel-itinerary dashboard.

---

## Features

### Frontend (HTML / CSS / Bootstrap / JavaScript)
- Fully responsive 3+ page layout (Home, Destinations, Contact, Auth, Dashboard)
- **Dynamic content updates** — destination filtering (Beach / Mountains / Culture / Wildlife)
- **Interactive image slider** — auto-playing hero slider with arrows + dots
- **Form validation** — client-side JS validation on register / login / contact forms
- **Smooth scrolling** — navbar & footer links scroll smoothly to sections
- **Event handling** — hover effects, mobile menu collapse, card tooltips
- **Custom animations** — scroll-reveal fade-ins and animated stat counters

### Backend (PHP + MySQL)
- **User registration** (`auth/register.php`) — passwords hashed with `password_hash()`
- **User login** (`auth/login.php`) — credentials verified with `password_verify()`, session started
- **Logout** (`auth/logout.php`) — session destroyed
- **Contact form** (`contact.php`) — submissions stored in the `messages` table
- **Dashboard** (`dashboard.php`) — logged-in users can add/delete trips (itinerary)
- All SQL queries use prepared statements (SQL-injection safe)

---

## Folder Structure

```
trapowalks/
├── css/
│   └── style.css            # Custom styles & animations
├── js/
│   └── main.js              # Slider, filtering, validation, smooth scroll
├── images/                  # SVG artwork used across the site
├── includes/
│   ├── db.php               # MySQLi connection
│   └── functions.php        # Helpers: sanitize(), sessions, auth guards
├── auth/
│   ├── register.php         # Sign-up
│   ├── login.php            # Login
│   └── logout.php           # Logout
├── contact.php              # Contact form handler
├── index.html               # Main page (static HTML frontend)
├── dashboard.php            # User itinerary dashboard
├── database.sql             # Database export (import via phpMyAdmin)
└── README.md
```

---

## How to Run (XAMPP)

1. **Copy the project** into your XAMPP web root:
   - Windows: `C:\xampp\htdocs\trapowalks`
   - macOS: `/Applications/XAMPP/htdocs/trapowalks`
   - Linux: `/opt/lampp/htdocs/trapowalks`

2. **Start Apache and MySQL** from the XAMPP Control Panel.

3. **Create the database:**
   - Open `http://localhost/phpmyadmin`
   - Click **Import** → choose `database.sql` → **Go**
   - (The script creates the `trapowalks` database with all tables and sample data.)

4. **Open the app:**
   - Frontend: `http://localhost/trapowalks/index.html`
   - Register a new account, then log in to access the dashboard.

> Default DB credentials in `includes/db.php` are `root` / `` (empty password) — the XAMPP defaults.

### Demo account (from sample data)
| Email | Password |
|---|---|
| demo@trapowalks.lk | demo123 |

---

## Submission Checklist (per project guide)
- [x] 3+ pages, fully responsive (Bootstrap grid + custom media queries)
- [x] 6 JavaScript features implemented (slider, filtering, validation, smooth scroll, event handling, animations)
- [x] MySQL database locally via XAMPP (`trapowalks`)
- [x] `users` table (id AUTO_INCREMENT, username, email, hashed password, created_at)
- [x] Theme tables: `trips` and `messages`
- [x] Registration / Login / Logout with sessions & `password_hash()`
- [x] Contact form storing into `messages`
- [x] Frontend forms connected to PHP/MySQL, JS validation retained
- [x] `database.sql` export included
- [x] README with setup steps
