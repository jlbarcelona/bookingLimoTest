# Booking System (Test Phase)

A simple and efficient booking system built with Laravel. This project allows users to make bookings online for boundlesslimousine.

---

## Features

- Client booking creation
- Booking confirmation system
- Responsive UI
- API-ready structure for future enhancements
- Full Form Validation
- Multiple Stop points
- Client Validations
- Map Reading base on the locations

---

## Tech Stack

- Laravel 10+
- MySQL / MariaDB
- Bootstrap 5
- Blade Templates
- jQuery (optional)

---

## Installation Guide

### 1. Clone the repository

git clone https://github.com/jlbarcelona/bookingLimoTest.git
cd booking-system

---

### 2. Install dependencies

composer install

---

### 3. Copy environment file

cp .env.example .env

---

### 4. Configure environment

Update your `.env` file:

APP_NAME="Booking System" 
APP_URL=http://localhost  

DB_DATABASE=your_database  
DB_USERNAME=your_username  
DB_PASSWORD=your_password  

---

### 5. Generate application key

php artisan key:generate

---

### 6. Run migrations

php artisan migrate

(Optional)

php artisan db:seed

---

### 7. Start local server

php artisan serve

Open in browser:

http://127.0.0.1:8000

---

## Main Goal

- Customer booking portal (instant quotes, reservations)
- Admin/dispatch dashboard
- Chauffeur mobile app (iOS/Android)
- Payment integration (Stripe)
- Google Maps integration (distance, routing, tracking)

---

## License

This project is open-source and free to use for learning and personal development.