# Vaccine Registration System

A Laravel-based web application for managing vaccine registrations, scheduling appointments, and administering the registration process.

---

## 🏷️ Features

- User registration with personal details (name, age, contact, etc.)
- Booking vaccine appointment slots
- Admin dashboard to review, approve, reject registrations
- View, search and filter registered users and appointments
- Role-based access (user vs admin)
- Notification or status update for users (pending, approved, rejected)

---

## 🧰 Tech Stack

- **Framework:** Laravel (PHP)  
- **Database:** MySQL / SQLite / other supported by Laravel  
- **Frontend:** Blade templates, HTML/CSS, basic JS  
- **Other:** Laravel’s built-in authentication, routing, Eloquent ORM, migrations, etc.

---

## 📁 Directory Structure

Below is a sample directory layout. Your actual structure might differ slightly:

/
├── app/
│ ├── Http/
│ │ ├── Controllers/
│ └── Models/
├── bootstrap/
├── config/
├── database/
│ ├── migrations/
│ └── seeders/
├── public/
├── resources/
│ ├── views/
│ └── css/js assets
├── routes/
│ └── web.php, api.php
├── storage/
├── tests/
├── .env.example
├── composer.json
└── README.md




# 🚀 Getting Started

### Prerequisites

- PHP >= 8.2 (or version supported by the project)
- Composer
- MySQL (or alternative DB)
- Web server (Apache, Nginx, or use `php artisan serve`)

---

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/talhajoy/Vaccine-Registration-System.git
   cd Vaccine-Registration-System


