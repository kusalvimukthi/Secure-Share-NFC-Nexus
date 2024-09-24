# Secure Share NFC Nexus 🚀

![License](https://img.shields.io/badge/license-MIT-green)
![Laravel](https://img.shields.io/badge/Framework-Laravel-red)
![Contributors](https://img.shields.io/github/contributors/kusal/nfc-app123)
![Version](https://img.shields.io/badge/version-1.0-blue)

> **Secure Share NFC Nexus** is a cutting-edge, Laravel-based system designed to provide a comprehensive NFC-powered information-sharing platform. The system manages various NFC items like Smart Business Cards, Secure Wallets, Custom Cards, Pet Details, and Bulk Storage Tags, empowering seamless, secure information exchanges. This platform features both an **Admin Portal** for management and a **Customer Portal** for NFC cardholders to manage their assets.

## Key Features 💡
- **NFC Card Management**: Business cards, secure wallets, pet tags, and more.
- **AI-Powered Password Strength Validation**: Enhanced security for user credentials.
- **User and Admin Portals**: Separate interfaces for customers and administrators.
- **NFC Writing & Management**: Write, disable, or manage NFC card details from the admin interface.
- **Email Notifications**: Automatic notifications for password setting and card deactivation.
- **OTP-Based Wallet Access**: Secure wallets require OTP authentication for extra security.

---

## Demo 🎥

![Secure Share NFC Nexus Demo](https://secureshare.novatechlane.net/storage/dashboard123.png)

[Watch Demo Video](https://secureshare.novatechlane.net/storage/Sequoia.mp4)
---

## Table of Contents 📚
- [Introduction](#introduction)
- [Features](#key-features)
- [Demo](#demo)
- [Installation](#installation-guide)
- [Technology Stack](#technology-stack)
- [License](#license)

---

## Installation Guide 🛠️

Follow these steps to install and set up the **Secure Share NFC Nexus** project on your local machine.

### Prerequisites:
Ensure you have the following installed on your system:
- PHP 7.4+
- Composer
- MySQL
- Node.js & NPM (for frontend assets)
- Git

### Step 1: Clone the Repository

```jsx
git clone https://github.com/kusalivmukthi/Secure-Share-NFC-Nexus.git
cd Secure-Share-NFC-Nexus 
```


### Step 2: Configure the Environment
1) Copy the .env.example file to create your own environment file:
```jsx
cp .env.example .env
```

2) Open .env and configure your database and other environment variables:
```jsx
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```


### Step 3: Install Dependencies

1)Install PHP dependencies using Composer:
```jsx
composer install
```

2)Install Node.js dependencies for the frontend:
```jsx
npm install
npm run dev
```


### Step 4: Set Up Database
Run migrations and seeders to set up the database tables:
```jsx
php artisan migrate --seed
```


### Step 5: Create Storage Link
```jsx
hp artisan storage:link
```


### Step 6: Run the Application
Start the development server:
```jsx
php artisan serve
```
Open your browser and go to http://127.0.0.1:8000.



## Technology Stack 🛠️
- Laravel - Backend Framework
- MySQL - Database
- JavaScript & Vue.js - Frontend UI
- Python & Flask - AI-Powered Password Strength Validation
- NFC - Near Field Communication for Smart Cards


## License 📄
Distributed under the MIT License. See [LICENSE](./LICENSE) for more information.


## Contact 📧
- Kusal Vimukthi - kusal@gmail.com
- Project Link: https://github.com/kusalivmukthi/Secure-Share-NFC-Nexus.git

---