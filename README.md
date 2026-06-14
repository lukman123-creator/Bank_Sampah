<div align="center">
    <img src="public/logo.png" alt="Bank Sampah Logo" width="120" style="border-radius: 50%;">
    <h1>♻️ Bank Sampah Application</h1>
    <p>A modern, interactive, and fully-featured Waste Management System built with Laravel.</p>

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev/)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)

</div>

---

## 📖 About The Project

**Bank Sampah** is a web-based application designed to digitalize waste management processes. It enables users to deposit their waste in exchange for a virtual balance, which can later be redeemed for various rewards (e.g., Groceries, Phone Credit, Vouchers). The system is designed with a modern, glassmorphic UI, dynamic number animations, and seamless Google OAuth integration.

## ✨ Key Features

### 👤 User Features
- **Google OAuth Login:** Seamless, one-click sign-in and registration via Google.
- **Interactive Dashboard:** Modern tracking of deposited waste, total balance, and transaction history.
- **Reward Catalog:** Redeem accumulated balance for physical or digital rewards (Simulated Withdrawals).
- **Responsive & Dynamic UI:** Built with Tailwind CSS, featuring full **Dark/Light Mode** support and satisfying micro-animations (AlpineJS).

### 🛡️ Admin Features
- **Centralized Dashboard:** Comprehensive analytics with animated counters and charts.
- **Transaction Management:** Approve, decline, or review waste deposits and reward redemptions.
- **Reward Management (CRUD):** Dynamically add, edit, or delete items available in the Reward Catalog.
- **Automated Calculations:** Accurate logic for total deposits vs. total payouts.

---

## 🛠️ Tech Stack

- **Backend:** [Laravel 11](https://laravel.com)
- **Frontend UI:** Blade Templates, [Tailwind CSS](https://tailwindcss.com) (Vanilla), Glassmorphism UI
- **Frontend Logic:** [Alpine.js](https://alpinejs.dev)
- **Database:** MySQL
- **Authentication:** Laravel Breeze, Laravel Socialite (Google Provider)

---

## 🚀 Getting Started

Follow these instructions to set up the project locally on your machine.

### Prerequisites
Make sure you have the following installed:
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL (XAMPP/Laragon/DBngin)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/lukman123-creator/Bank_Sampah.git
   cd Bank_Sampah
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies & build assets**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   Copy the example `.env` file and generate the application key.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure the Database & Google OAuth**
   Open the `.env` file and configure your local database connection:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bank_sampah_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *Note: Ensure you have created an empty database named `bank_sampah_db` in your MySQL server.*

   Add your Google OAuth Credentials:
   ```env
   GOOGLE_CLIENT_ID=your-client-id.apps.googleusercontent.com
   GOOGLE_CLIENT_SECRET=your-client-secret
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```

6. **Migrate and Seed the Database**
   This command will build the database schema and populate it with the default Admin account and initial Reward Catalog items.
   ```bash
   php artisan migrate --seed
   ```

7. **Run the Application**
   ```bash
   php artisan serve
   ```
   The application will be accessible at `http://localhost:8000`.

---

## 🔑 Default Credentials

After running the database seeder, an Admin account is automatically generated for testing purposes:

- **Email:** `admin@banksampah.com`
- **Password:** `password`

*Regular users can register or log in using the "Sign in with Google" button.*

---

## 📜 License

Distributed under the MIT License. See `LICENSE` for more information.

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the issues page.
