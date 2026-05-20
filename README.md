# 🎓 College Management System — Academy Keeper

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![jQuery](https://img.shields.io/badge/jQuery%20(AJAX)-0769AD?style=for-the-badge&logo=jquery&logoColor=white)

A comprehensive, role-based College Management System built to streamline academic operations, enhance communication, and improve the educational experience for students, faculty, and administrators.

[Features](#features) · [Screenshots](#screenshots) · [Getting Started](#getting-started) · [Project Structure](#project-structure) · [Roles](#user-roles)

</div>

---

## 📖 Overview

**Academy Keeper** is a full-stack College Management System that centralizes the day-to-day operations of an academic institution into a single, user-friendly platform. It provides dedicated portals for **Administrators**, **Faculty**, and **Students**, each with role-specific tools and dashboards.

The system covers everything from student enrollment and attendance tracking to financial management and exam scheduling — making campus administration efficient and transparent.

---

## Features

### 🏠 Public Landing Page
- Hero section with call-to-action for prospective students
- Highlights the platform's key benefits (efficiency, communication, resource management, student engagement)
- About section and contact form for inquiries

### 🔐 Authentication System
- Unified login page with three role tabs: **Administrator**, **Faculty**, and **Student**
- Secure ID + password authentication
- "Remember Me" and "Forgot Password" support
- New user sign-up flow

### 🛡️ Admin Dashboard
- Real-time stats: Total Students, Total Faculty, Attendance Rate, Total Courses
- **Earnings Overview** — line chart comparing monthly income vs. expenditures
- **Upcoming Events** — create, edit, and delete scheduled campus events
- **Upcoming Holidays** — manage and display holiday calendar
- **Quick Actions** — shortcut buttons to add Events, Holidays, and Finance entries
- 12-month Income-Expenditure breakdown table

### 👨‍🏫 Faculty Management
- View all faculty members with department, position, salary, contact info, and status
- Faculty status overview (Active / On Leave) with a donut chart
- Monthly teacher absence bar chart
- Add new faculty, mark or edit attendance records
- Add administrator accounts directly from this panel

### 🎓 Student Management
- Enroll and manage student records
- Track student attendance and academic progress

### 📚 Course Management
- Create and manage courses across departments
- Assign faculty to courses

### 💰 Financial Management
- Track institutional earnings and expenditures
- Generate monthly financial reports

### 📝 Exam Management
- Schedule and manage exams
- Record and view results

---

## Screenshots

### Landing Page
<img width="1755" height="3012" alt="Landing" src="https://github.com/user-attachments/assets/dce785ae-03ec-4916-81fb-c4c7eb38e67f" />


### Login Page
<img width="1755" height="848" alt="Login" src="https://github.com/user-attachments/assets/dc23e143-5549-4a4c-9534-b1fdebad1b8a" />


### Admin Dashboard
<img width="1755" height="1423" alt="ad" src="https://github.com/user-attachments/assets/1c0df49c-9055-42c6-a28a-e58725c54e3a" />


### Faculty Management
<img width="1755" height="1774" alt="Faculty" src="https://github.com/user-attachments/assets/b6415efa-8494-477f-9c2e-10a782b3b148" />


---

## Project Structure

```
CMS/
├── index.php            # Public landing page (entry point)
├── front/               # Frontend pages (login, signup, etc.)
├── Dashboard/           # Role-based dashboard views & logic
│   ├── admin/           # Admin panel pages
│   ├── faculty/         # Faculty panel pages
│   └── student/         # Student panel pages
├── css/                 # Custom stylesheets
├── js/                  # JavaScript & AJAX scripts
├── img/                 # Images and media assets
├── .gitignore
└── README.md
```

---

## User Roles

| Role | Access Level | Key Capabilities |
|------|-------------|-----------------|
| **Administrator** | Full access | Manage all users, courses, finance, events, exams |
| **Faculty** | Partial access | Manage attendance, view courses, update grades |
| **Student** | Read access | View grades, attendance, courses, and schedules |

---

## Getting Started

### Prerequisites

- PHP `>= 7.4`
- MySQL / MariaDB
- Apache or Nginx web server (e.g., via [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/))

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/AvisarBhandari/CMS.git
   cd CMS
   ```

2. **Move to your server's web root**
   ```bash
   # Example for XAMPP on Windows
   cp -r CMS/ C:/xampp/htdocs/CMS
   ```

3. **Set up the database**
   - Open `phpMyAdmin` (or your preferred MySQL client)
   - Create a new database (e.g., `college_cms`)
   - Import the provided SQL file (if included) or run the setup script

4. **Configure the database connection**
   - Locate the database config file (e.g., `Dashboard/config.php` or similar)
   - Update the credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'college_cms');
     ```

5. **Start your server and open the app**
   ```
   http://localhost/CMS/
   ```

6. **Log in** using the Admin credentials to begin setup.

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, Bootstrap 5 |
| Interactivity | JavaScript, jQuery, AJAX |
| Backend | PHP |
| Database | MySQL |
| IDE | VS Code |

---

## 🌐 Language Breakdown

```
PHP          69.3%   ██████████████░░░░░░
JavaScript   14.3%   ███░░░░░░░░░░░░░░░░░
CSS           8.9%   ██░░░░░░░░░░░░░░░░░░
HTML          5.8%   █░░░░░░░░░░░░░░░░░░░
Other         1.7%   ░░░░░░░░░░░░░░░░░░░░
```


---

<div align="center">
  <sub>© 2024 Academy Keeper — All Rights Reserved</sub>
</div>
