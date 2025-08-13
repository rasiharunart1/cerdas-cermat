<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

# Cerdas Cermat - Real-time Buzzer Quiz System

A Laravel-based real-time multi-participant buzzer quiz system with Filament admin panel and Livewire components.

## Features

- **Real-time buzzer system** - Participants can buzz in to answer questions
- **Live scoring** - Scores update in real-time across all participants
- **Host control panel** - Complete quiz management interface
- **Admin panel** - Filament-based administration for managing competitions, questions, and participants
- **Responsive design** - Works on desktop and mobile devices
- **Indonesian language** - UI text in Bahasa Indonesia

## Tech Stack

- **Backend**: Laravel 11, MySQL/SQLite
- **Frontend**: Livewire 3, Alpine.js, Tailwind CSS
- **Real-time**: Pusher (WebSocket broadcasting)
- **Admin Panel**: Filament 3
- **Authentication**: Laravel Breeze
- **Permissions**: Spatie Laravel Permission

## Quick Setup

1. **Clone and install dependencies**:
```bash
git clone <repository-url>
cd cerdas-cermat
composer install
npm install
```

2. **Environment setup**:
```bash
cp .env.example .env
php artisan key:generate
```

3. **Database setup**:
```bash
# For SQLite (default)
touch database/database.sqlite

# Run migrations and seeders
php artisan migrate --seed
```

4. **Configure Pusher** (for real-time features):
```env
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
```

5. **Build assets and start**:
```bash
npm run build
php artisan serve
```

## Usage

### Demo Competition
- **Competition Code**: `DEMO123`
- Visit `/join` to join as a participant
- Visit `/host/1` to access the host control panel
- Visit `/admin` for the Filament admin panel

### Host Panel
1. Navigate to `/host/{competition_id}`
2. Set competition status to "Running"
3. Select and open questions for participants
4. Monitor buzzes and award points
5. View real-time leaderboard

### Participant Experience
1. Visit `/join` or `/p/{competition_code}`
2. Enter competition code and display name
3. Wait for host to open questions
4. Press the BEL button to buzz in
5. View live scores and competition status

### Admin Panel
- Access at `/admin` (requires authentication)
- Manage competitions, questions, and participants
- Create new quiz content
- Monitor competition progress

## API Endpoints

- `POST /competitions/{competition}/question/open` - Open a question
- `POST /competitions/{competition}/buzz` - Participant buzz
- `POST /competitions/{competition}/answer/correct` - Mark answer correct
- `POST /competitions/{competition}/answer/wrong` - Mark answer wrong  
- `POST /competitions/{competition}/question/next` - Move to next question

## Database Schema

- **competitions**: Quiz competitions with status tracking
- **questions**: Quiz questions (MCQ or short answer)
- **question_options**: Multiple choice options
- **participants**: Competition participants with scores
- **buzzes**: Participant buzzing records with latency
- **answers**: Answer submissions and scoring

## Legacy Quiz

The original simple JavaScript quiz has been preserved in the `legacy-quiz/` folder.

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is open-sourced software licensed under the MIT license.
