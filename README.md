# projet_gestion_etudiant_ROMANE_php
 web-based Student Management System developed using **PHP (OOP)** and **PDO**, with Bootstrap for responsive UI. This application allows users to manage student records through basic CRUD (Create, Read, Update, Delete) operations and file uploads (photo and CV).

## 📝 Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)

## 📌 Features

- View list of all registered students
- Add a new student with photo and CV upload
- Edit and update student records
- Delete student records
- Validation for all form inputs
- Password confirmation checks
- User feedback through session-based alert messages

## 🧰 Technologies Used

- PHP (OOP + PDO)
- HTML5, CSS3
- Bootstrap (responsive design)
- MySQL Database

## 🚀 Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/HibaROMANE/projet_gestion_etudiant_ROMANE_php.git
   cd projet_gestion_etudiant_ROMANE_php
   
2. Import the database:
   - Create a database in MySQL (e.g., `compte_etudiants`)
   - Import the SQL file if provided, or manually create the required tables using phpMyAdmin or MySQL CLI

3. Configure the database connection:
   - Open the `ClassEtudiant.php` file
   - Locate the PDO connection and update it with your database credentials (host, database name, username, password)

4. Run the application:
   - Place the project folder in the root directory of your local web server (e.g., `htdocs` for XAMPP, `www` for WAMP/Laragon)
   - Start your local server and open the project in your browser (e.g., `http://localhost/projet_gestion_etudiant_ROMANE_php`)

## 📂 Project Structure

├── comptes.php                     # Main page listing all student accounts
├── ajouter_compte.php             # Form to add a new student
├── enregistrer_compte.php         # Logic to store new student data
├── supprimer_compte.php           # Logic to delete student by ID
├── modifier_compte.php            # Form to edit student information
├── enregistrer_modifier_compte.php# Logic to update student data
├── ClassEtudiant.php              # Core PHP class handling all operations
├── trombinoscope.php              # (Optional) Grid view of student photos
├── uploads/                       # Directory to store uploaded CVs/photos
└── assets/                        # CSS, JS, Bootstrap files
