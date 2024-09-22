# Simple Blog Script 

## Requirements

To run this project, you'll need the following:

- PHP ^7.4|^8.0
- Composer
- MySQL or another database management system
- Git
- An SMTP server (for email sending)

## Installation Steps

### 1. Clone the Project

First, clone the project from GitHub:

```bash
git clone https://github.com/bugraskl/laravel-blog-script.git
cd project_name
```

### 2. Install Dependencies
Use Composer to install PHP dependencies:

```bash
composer install
```

### 3. Configure the .env File
```bash
cp .env.example .env
```
Edit the .env file and update the following values according to your setup:

```bash
APP_NAME=ProjectName
APP_ENV=local
APP_KEY=base64:... (This will be generated in the next step)
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 4. Generate the Application Key

```bash
php artisan key:generate
```

### 5. Create the Database

```bash
CREATE DATABASE your_database_name;
```

### 6. Migrate the Database

```bash
php artisan migrate
```

### 7. Seed the Database

```bash
php artisan db:seed
```

### 8. Run the Server

```bash
php artisan serve
```
