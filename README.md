# Mishrajii Gym Management System

## Overview

The **Mishrajii Gym Management System** is a comprehensive web-based application that streamlines gym operations, including user registration, membership management, scheduling classes, and admin dashboard features. This system is designed to improve the management experience for admins while providing a seamless experience for gym members.

## Features

- **User Registration and Login**: Users can register, log in, and access their profiles.
- **Admin Dashboard**: Allows admins to manage memberships, create schedules, and assign trainers.
- **Membership Management**: Includes multiple membership plans, such as Basic, Ultimate, and Premium.
- **Class Scheduling**: Admins and trainers can create, update, and manage class schedules.
- **Profile Management**: Users can view and update their personal information in the profile section.
- **Real-time Notifications**: Notifications for important updates related to classes, schedules, and memberships.
  
## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Development Environment**: XAMPP, VS Code
- **Additional Libraries**: FontAwesome for icons

## Project Structure

```plaintext
mishrajii-gym/
├── assets/               # Images, icons, and other static assets
├── css/                  # CSS stylesheets
├── js/                   # JavaScript files
├── includes/             # PHP includes (header, footer, etc.)
├── admin/                # Admin dashboard and related functionalities
├── users/                # User pages and profile management
└── index.php             # Main entry point
```
## Installation Guide
**Prerequisites**
- Install XAMPP to run PHP and MySQL locally.
- Install a code editor like VS Code.

# Setup Instructions
1. Clone the Repository:
   ```
   git clone https://github.com/yourusername/mishrajii-gym.git
   ```
2. Start XAMPP:

-- Open XAMPP and start the Apache and MySQL services.

3. Database Configuration:

-- Open phpMyAdmin in your browser by going to http://localhost/phpmyadmin.
-- Create a new database (e.g., gym_management).
-- Import the SQL file provided in the /db folder of the project to set up tables.

4. Configure Database Connection:

-- In the project files, open config.php (or similar configuration file).
-- Set your MySQL database credentials
```
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gym_management');

```
5. Run the Project:

-- Place the project folder inside the htdocs directory of XAMPP.
-- Go to your browser and enter

## Icon Dependency
-- This project uses FontAwesome for icons. Ensure FontAwesome is available for proper icon rendering.

Option 1: Download FontAwesome locally:
-- Download FontAwesome and place it in the project directory.
Option 2: Use the CDN link in HTML files
```
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
```
## Usage
-- Admin Login: Access the admin panel to manage users, memberships, and classes.
-- User Registration: Users can register to apply for memberships, view class schedules, and update their profiles.
Contributing
We welcome contributions to improve the project. Here’s how you can contribute:

1. Fork the repository.
2. Create a feature branch
```
git checkout -b feature-name
```
3. Commit changes and create a pull request.

## Limitations
-- Internet Dependency: Some features require internet access to load FontAwesome icons if using the CDN.
-- Payment Integration: Currently, no online payment feature is implemented for membership fees.

## Conclusion
The Mishrajii Gym Management System is an all-in-one platform for managing gym operations. It provides admins with easy control over memberships and class schedules and enhances the user experience for gym members. With further development, it can be expanded to include payment gateways and mobile responsiveness.
