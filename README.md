# Apnabooking.com - Movie Ticket Booking System

Apnabooking.com is a core PHP web application for movie ticket booking. It provides a complete user flow from account creation to booking confirmation, plus an admin area for managing movie details.

The project is built without frameworks and uses a straightforward PHP + MySQL architecture, making it easy to understand, run locally, and extend for academic or portfolio use.

## Project Highlights

- User authentication with session-based access control
- Movie browsing with detailed movie pages
- Ticket booking with seat and date selection
- Booking history and ticket cancellation workflow
- Admin controls for movie updates
- Simple modular layout using reusable partial files

## Technology Stack

- Backend: Core PHP
- Frontend: HTML, CSS, JavaScript
- Database: MySQL
- Local server (recommended): XAMPP or WAMP

## Project Structure

Main files:

- index.php: User login page
- signup.php: New user registration
- home.php: Landing page after login
- movie_details.php: Movie information page
- booking.php: Ticket booking form
- booking_process.php: Booking processing and confirmation
- ticket.php: User ticket listing and management
- admin.php: Admin dashboard for movie management
- update_movie.php: Admin movie update handler
- delete_ticket.php: Ticket cancellation handler
- about.php: About page

Folders:

- css/: Stylesheets
- database/: SQL schema and initial data
- partials/: Shared PHP partials and utilities
  - _config.php: Database connection settings
  - _navbar.php: Shared authenticated navbar
  - logout.php: Session logout endpoint
- static/: Media assets (logo, video, etc.)

## Setup Instructions

Follow these steps to run the project locally.

1. Clone or download this repository.
2. Place the project folder inside your web root:
	- XAMPP: htdocs
	- WAMP: www
3. Start Apache and MySQL from your local server control panel.
4. Create a new database named ticket_booking in phpMyAdmin.
5. Import the SQL file from database/ticket_booking.sql.
6. Open partials/_config.php and verify database credentials:
	- DB server
	- DB username
	- DB password
	- DB name
7. Open the app in your browser:
	- http://localhost/ticket_booking/

## Default Workflow

User flow:

1. Register a new account from signup.php.
2. Sign in via index.php.
3. Browse movies on home.php.
4. Open a movie from movie_details.php.
5. Book tickets from booking.php.
6. View and manage booked tickets in ticket.php.

Admin flow:

1. Sign in with an admin account.
2. Open admin.php.
3. Update movie details using the admin interface.

## Security and Validation Notes

- Session checks are used to protect authenticated routes.
- Basic input sanitization and validation are present.
- This is an academic/project-level implementation and should be hardened further before production use.

## Suggested Improvements

- Add prepared statements for all SQL queries
- Add CSRF protection for sensitive actions
- Implement role middleware and centralized authorization checks
- Add server-side form validation utilities
- Add payment gateway integration for real transactions
- Add unit and integration tests

## License

This project is intended for educational use. If you plan to publish or deploy commercially, define and add a formal license file.

