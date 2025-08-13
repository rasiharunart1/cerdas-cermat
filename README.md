# Cerdas Cermat - Real-time Multi-Participant Buzzer Quiz System

## Project Overview / Gambaran Proyek
**English:** A real-time multi-participant buzzer quiz system built with Laravel 11, Livewire 3, Filament 3, and Pusher for live broadcasting.

**Bahasa Indonesia:** Sistem quiz buzzer multi-peserta real-time yang dibangun dengan Laravel 11, Livewire 3, Filament 3, dan Pusher untuk broadcasting langsung.

## Vision / Visi
Create a competitive quiz platform where multiple participants can join competitions using unique codes, with first-buzz atomicity ensuring fair play, comprehensive host controls, and a powerful admin panel for content management.

*Menciptakan platform quiz kompetitif dimana multiple peserta dapat bergabung dalam kompetisi menggunakan kode unik, dengan atomicity first-buzz yang memastikan permainan fair, kontrol host yang komprehensif, dan panel admin yang powerful untuk manajemen konten.*

## Key Features / Fitur Utama

### For Participants / Untuk Peserta
- Join competitions with unique room codes / *Bergabung kompetisi dengan kode ruangan unik*
- Real-time buzzer system with first-press advantage / *Sistem buzzer real-time dengan keuntungan tekan pertama*
- Live score tracking and leaderboards / *Pelacakan skor langsung dan papan peringkat*
- Mobile-responsive interface / *Antarmuka responsif mobile*

### For Hosts / Untuk Host
- Create and manage competition rooms / *Membuat dan mengelola ruangan kompetisi*
- Real-time participant monitoring / *Monitoring peserta real-time*
- Question flow control (start, pause, next) / *Kontrol alur pertanyaan (mulai, pause, lanjut)*
- Live scoring and result management / *Penilaian langsung dan manajemen hasil*

### For Administrators / Untuk Administrator
- Complete content management system / *Sistem manajemen konten lengkap*
- Question bank with categories / *Bank soal dengan kategori*
- User role management / *Manajemen peran pengguna*
- Competition analytics and reports / *Analitik dan laporan kompetisi*

## Planned Architecture / Arsitektur yang Direncanakan

### Database Schema / Skema Database
- `competitions` - Competition room data / *Data ruangan kompetisi*
- `participants` - Participant information / *Informasi peserta*
- `questions` - Question bank with categories / *Bank soal dengan kategori*
- `buzzes` - Real-time buzz records / *Rekaman buzz real-time*
- `answers` - Participant answers / *Jawaban peserta*
- `competition_participants` - Many-to-many pivot / *Tabel pivot many-to-many*

### Broadcasting Events / Event Broadcasting
- `FirstBuzzed` - When first participant presses buzzer / *Ketika peserta pertama menekan buzzer*
- `QuestionOpened` - New question becomes available / *Pertanyaan baru tersedia*
- `ScoreUpdated` - Real-time score changes / *Perubahan skor real-time*
- `CompetitionStateChanged` - Room state updates / *Update status ruangan*

### Livewire Components / Komponen Livewire
- `JoinCompetition` - Room joining interface / *Antarmuka bergabung ruangan*
- `BuzzerButton` - Interactive buzzer / *Buzzer interaktif*
- `ControlPanel` - Host control dashboard / *Dashboard kontrol host*
- `ScoreBoard` - Live scores display / *Tampilan skor langsung*

## Setup Plan / Rencana Setup
**⚠️ Coming in next PR / Akan hadir di PR berikutnya**

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies  
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database migrations
php artisan migrate

# Pusher configuration
# Configure PUSHER_* variables in .env
```

## Local Development Quick Start / Panduan Cepat Development Lokal
**⚠️ Placeholder - Implementation coming soon / Placeholder - Implementasi segera hadir**

```bash
# Start Laravel development server
php artisan serve

# Start Vite development server (in separate terminal)
npm run dev

# Access admin panel
# URL: http://localhost:8000/admin
```

## Roadmap / Peta Jalan

### ✅ Phase 0: Foundation (Current PR)
- [x] Repository organization and documentation
- [x] Legacy quiz preservation
- [x] Project structure setup

### 🔄 Phase 1: Laravel Skeleton (Next PR)
- [ ] Laravel 11 installation and basic structure
- [ ] Environment configuration
- [ ] Basic routing and controllers

### 📋 Phase 2: Authentication & Livewire
- [ ] Laravel Breeze integration
- [ ] Livewire 3 scaffolding
- [ ] Basic user management

### 🗃️ Phase 3: Database & Models
- [ ] Migration files for all tables
- [ ] Eloquent models with relationships
- [ ] Database seeders for test data

### ⚡ Phase 4: Real-time Features
- [ ] Livewire components for competition flow
- [ ] Pusher integration for broadcasting
- [ ] Buzzer system implementation

### 🔧 Phase 5: Admin Panel
- [ ] Filament 3 installation
- [ ] Admin resources for all entities
- [ ] Role-based access control

### 🎨 Phase 6: Polish & Production
- [ ] UI/UX improvements
- [ ] Performance optimization
- [ ] Production deployment guide

## Contributing / Berkontribusi
Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

*Silakan baca [CONTRIBUTING.md](CONTRIBUTING.md) untuk detail tentang kode etik kami dan proses untuk mengirimkan pull request.*

## Legacy Application / Aplikasi Lama
The original JavaScript quiz application has been preserved in the `legacy-quiz/` folder for reference.

*Aplikasi quiz JavaScript asli telah disimpan di folder `legacy-quiz/` untuk referensi.*

## License / Lisensi
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
