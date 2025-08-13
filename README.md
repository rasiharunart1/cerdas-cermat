# Quiz Application

## Description
The Quiz Application is a web-based platform that allows users to take quizzes on various topics. It provides an interactive interface for users to answer questions and receive immediate feedback on their performance.

## Features
- User-friendly interface
- Multiple choice questions
- Timer for each quiz
- Score calculation and display
- Responsive design for mobile and desktop

## Installation
To install the Quiz Application, follow these steps:
1. Clone the repository:
   ```
   git clone https://github.com/rasiharunart1/cerdas-cermat.git
   ```
2. Navigate to the project directory:
   ```
   cd cerdas-cermat
   ```
3. Install the necessary dependencies:
   ```
   npm install
   ```

## Usage
To start the application, run:
```
npm start
```
Open your browser and go to `http://localhost:3000` to access the quiz application.

## Contributing
Contributions are welcome! Please follow these steps:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Open a Pull Request.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## PR A: Laravel 11 Skeleton (Scaffold)
This repository now includes a Laravel 11 skeleton scaffold to establish the project structure for future development. The scaffold includes:

- `composer.json` - Defines Laravel 11 and PHP 8.2+ requirements with PSR-4 autoloading
- `.env.example` - Pre-populated environment configuration template
- `public/index.php` - Informational landing page (does not bootstrap Laravel)
- `routes/web.php` - Commented placeholder for future route definitions
- `app/` - PSR-4 namespace root directory

### Local Development Setup
To run the Laravel application locally:
1. Install PHP 8.2+, Composer, and Node.js
2. Run `composer install` to install dependencies
3. Copy environment file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Start development server: `php artisan serve`

**Note:** CI intentionally skips dependency installation to avoid firewall restrictions.

### Pengembangan Lokal (Indonesian)
Untuk menjalankan aplikasi Laravel secara lokal:
1. Install PHP 8.2+, Composer, dan Node.js
2. Jalankan `composer install` untuk menginstall dependensi
3. Copy file environment: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Mulai development server: `php artisan serve`

The original quiz application remains available in the `legacy-quiz/` directory for reference.
