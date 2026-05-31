# Moto Shop Management System

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](http://makeapullrequest.com)

A comprehensive PHP-based management solution designed for motorcycle dealerships to streamline inventory tracking, customer relationships, and administrative tasks.

---

## 🚀 Features

- **Inventory Management**: Track and manage motorcycle stock with specialized listing modules.
- **Customer CRM**: Maintain a centralized database of customer information and interaction history.
- **User Administration**: Role-based access and user management for shop employees.
- **Settings & Profile**: Personalized user settings and system configuration panel.
- **Responsive Design**: Built with Bootstrap 5 to ensure compatibility across desktops, tablets, and mobile devices.

## 🛠 Tech Stack

- **Server-side**: PHP
- **Frontend Framework**: Bootstrap 5.3.8
- **Icons**: FontAwesome 6.5.1 & Bootstrap Icons 1.11.3
- **Styling**: Custom CSS Layouts

## 📦 Getting Started

### Prerequisites

Ensure you have the following installed:
- **Web Server**: XAMPP, WAMP, or Laragon (Apache)
- **PHP**: Version 8.0+ (Recommended)
- **Database**: MySQL 5.7+

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/nnatna/motoshop_ms.git
   cd motoshop_ms
   ```

2. **Database Setup (MySQL):**
   - Open phpMyAdmin or your MySQL client.
   - Create a new database named `motoshop_db`.
   - Import the provided SQL schema file (usually found in a `/database` or `/sql` folder).

3. **Database Configuration:**
   - Edit `db.php` in the root directory:
     ```php
     $conn = mysqli_connect("localhost", "username", "password", "motoshop_db");
     ```

4. **Run Project:**
   - Move the folder to your `htdocs` or `www` directory.
   - Visit `http://localhost/motoshop_ms` in your browser.
   ```

## 📖 Usage

1. **Login**: Access the system using your staff credentials.
2. **Inventory**: Add new motorcycles via the "Motorcycles" sidebar link.
3. **Reports**: Use the Reports section to filter transactions by date and print results.

## 📂 Project Structure

- `/layout`: Contains `header.php`, `sidebar.php`, and `footer.php`.
- `/assets`: Custom CSS/JS with cache-busting logic.
- `/reports`, `/motos`, `/user`: Module-specific view and logic files.

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

## ✉️ Contact

Email         : skyerkh@gmail.com & ngelratanaa@gmail.com

Project Link  : https://github.com/username/motoshop_ms
