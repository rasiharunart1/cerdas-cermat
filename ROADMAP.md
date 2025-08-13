# Development Roadmap / Peta Jalan Pengembangan

## Project Vision / Visi Proyek
Transform the current JavaScript quiz into a modern, real-time, multi-participant buzzer quiz system using Laravel 11, Livewire 3, Filament 3, and Pusher.

*Mengubah quiz JavaScript saat ini menjadi sistem quiz buzzer multi-peserta real-time yang modern menggunakan Laravel 11, Livewire 3, Filament 3, dan Pusher.*

---

## Phase 0: Foundation ✅
**Status:** COMPLETED / SELESAI  
**Current PR:** This PR / PR Ini

### Deliverables / Hasil
- [x] Legacy quiz preserved in `legacy-quiz/` folder
- [x] Repository structure reorganized
- [x] Comprehensive documentation (README, CONTRIBUTING)
- [x] GitHub templates (PR, issues)
- [x] Laravel-ready .gitignore
- [x] Network-free CI workflow
- [x] Development roadmap established

### Key Files Created / File Utama yang Dibuat
- `legacy-quiz/` - Preserved original quiz / Quiz asli yang dilestarikan
- `README.md` - New project documentation / Dokumentasi proyek baru
- `CONTRIBUTING.md` - Development guidelines / Panduan pengembangan
- `ROADMAP.md` - This roadmap / Peta jalan ini
- `.gitignore` - Laravel/Node ignore patterns / Pola ignore Laravel/Node
- `.github/workflows/ci.yml` - Basic CI / CI dasar
- `.github/ISSUE_TEMPLATE/` - Issue templates / Template issue

---

## Phase 1: Laravel Skeleton 🔄
**Status:** PLANNED / DIRENCANAKAN  
**Target:** Next PR / PR Berikutnya

### Goals / Tujuan
Establish Laravel 11 foundation without triggering network-dependent CI failures.

*Membangun fondasi Laravel 11 tanpa memicu kegagalan CI yang bergantung pada jaringan.*

### Deliverables / Hasil
- [ ] Clean Laravel 11 installation files
- [ ] Basic project structure (app/, config/, routes/)
- [ ] `.env.example` with required variables
- [ ] `composer.json` and `composer.lock` (committed, not installed in CI)
- [ ] Basic routes and controllers placeholders
- [ ] Database configuration setup
- [ ] Updated CI to skip `composer install`

### Anti-Blocking Strategy / Strategi Anti-Blokir
```yaml
# In CI workflow
- name: Validate Laravel structure
  run: |
    # Check files exist but don't install
    test -f composer.json && echo "✓ composer.json found"
    test -f artisan && echo "✓ artisan command found"
    # Skip: composer install, php artisan commands
```

### Key Files / File Utama
- `composer.json` - Laravel dependencies / Dependensi Laravel
- `artisan` - Laravel command interface / Interface perintah Laravel
- `app/` - Application logic / Logika aplikasi
- `config/` - Configuration files / File konfigurasi
- `routes/web.php` - Web routes / Rute web
- `.env.example` - Environment template / Template environment

---

## Phase 2: Authentication & Livewire 📋
**Status:** PLANNED / DIRENCANAKAN  
**Dependencies:** Phase 1 complete / Fase 1 selesai

### Goals / Tujuan
Add user authentication and Livewire 3 scaffolding for interactive components.

*Menambahkan autentikasi pengguna dan scaffolding Livewire 3 untuk komponen interaktif.*

### Deliverables / Hasil
- [ ] Laravel Breeze installation and configuration
- [ ] User registration, login, and password reset
- [ ] Role-based authentication (participant, host, admin)
- [ ] Livewire 3 setup with Alpine.js
- [ ] Basic component structure
- [ ] Responsive Tailwind CSS styling

### Components to Create / Komponen yang Akan Dibuat
- `App\Livewire\Auth\Login` - Login component / Komponen login
- `App\Livewire\Auth\Register` - Registration / Registrasi
- `App\Livewire\Dashboard` - User dashboard / Dashboard pengguna
- User roles and permissions system / Sistem peran dan izin pengguna

### Database Tables / Tabel Database
- `users` - User accounts / Akun pengguna
- `roles` - User roles (participant, host, admin) / Peran pengguna
- `role_user` - Pivot table / Tabel pivot

---

## Phase 3: Database Schema & Models 🗃️
**Status:** PLANNED / DIRENCANAKAN  
**Dependencies:** Phase 2 complete / Fase 2 selesai

### Goals / Tujuan
Implement complete database schema for competition system with proper relationships.

*Mengimplementasikan skema database lengkap untuk sistem kompetisi dengan relasi yang tepat.*

### Database Schema / Skema Database

#### Core Tables / Tabel Inti
```sql
-- Competitions / Kompetisi
competitions:
  - id (primary)
  - title (string)
  - description (text, nullable)
  - room_code (string, unique, 6 chars)
  - host_id (foreign: users.id)
  - status (enum: waiting, active, paused, finished)
  - max_participants (integer, default: 50)
  - question_time_limit (integer, seconds, default: 30)
  - created_at, updated_at

-- Questions / Pertanyaan
questions:
  - id (primary)
  - question_text (text)
  - category_id (foreign: categories.id)
  - difficulty_level (enum: easy, medium, hard)
  - time_limit (integer, seconds, nullable)
  - is_active (boolean, default: true)
  - created_by (foreign: users.id)
  - created_at, updated_at

-- Question Options / Opsi Jawaban
question_options:
  - id (primary)
  - question_id (foreign: questions.id)
  - option_text (string)
  - is_correct (boolean, default: false)
  - order_index (integer)

-- Categories / Kategori
categories:
  - id (primary)
  - name (string)
  - description (text, nullable)
  - color (string, nullable, hex color)
  - is_active (boolean, default: true)
```

#### Competition Tables / Tabel Kompetisi
```sql
-- Competition Participants / Peserta Kompetisi
competition_participants:
  - id (primary)
  - competition_id (foreign: competitions.id)
  - user_id (foreign: users.id)
  - joined_at (timestamp)
  - is_active (boolean, default: true)

-- Competition Questions / Pertanyaan Kompetisi
competition_questions:
  - id (primary)
  - competition_id (foreign: competitions.id)
  - question_id (foreign: questions.id)
  - order_index (integer)
  - is_asked (boolean, default: false)
  - asked_at (timestamp, nullable)

-- Buzzes / Buzz
buzzes:
  - id (primary)
  - competition_id (foreign: competitions.id)
  - question_id (foreign: questions.id)
  - user_id (foreign: users.id)
  - buzzed_at (timestamp, microseconds precision)
  - is_first (boolean, default: false)
  - response_time_ms (integer)

-- Answers / Jawaban
answers:
  - id (primary)
  - buzz_id (foreign: buzzes.id)
  - question_option_id (foreign: question_options.id)
  - is_correct (boolean)
  - answered_at (timestamp)
  - time_taken_ms (integer)

-- Scores / Skor
scores:
  - id (primary)
  - competition_id (foreign: competitions.id)
  - user_id (foreign: users.id)
  - question_id (foreign: questions.id)
  - points_earned (integer)
  - total_points (integer)
  - calculated_at (timestamp)
```

### Models & Relationships / Model & Relasi
- `Competition` hasMany `CompetitionParticipants`, `Buzzes`, `Scores`
- `User` hasMany `Competitions` (as host), belongsToMany `Competitions` (as participant)
- `Question` belongsTo `Category`, hasMany `QuestionOptions`, `Buzzes`
- `Buzz` belongsTo `User`, `Competition`, `Question`, hasOne `Answer`

### Seeders / Seeder
- `CategorySeeder` - Default categories / Kategori default
- `QuestionSeeder` - Sample questions / Pertanyaan contoh
- `UserSeeder` - Test users with different roles / Pengguna test dengan peran berbeda

---

## Phase 4: Real-time Features ⚡
**Status:** PLANNED / DIRENCANAKAN  
**Dependencies:** Phase 3 complete / Fase 3 selesai

### Goals / Tujuan
Implement core real-time functionality with Livewire and Pusher integration.

*Mengimplementasikan fungsi real-time inti dengan integrasi Livewire dan Pusher.*

### Broadcasting Events / Event Broadcasting
```php
// Real-time events
FirstBuzzed:
  - competition_id
  - question_id
  - user_id
  - buzzed_at
  - is_first_buzz

QuestionOpened:
  - competition_id
  - question_id
  - question_data
  - time_limit
  - started_at

ScoreUpdated:
  - competition_id
  - user_scores[]
  - leaderboard_data

CompetitionStateChanged:
  - competition_id
  - new_status
  - metadata

ParticipantJoined:
  - competition_id
  - user_id
  - participant_count

AnswerRevealed:
  - competition_id
  - question_id
  - correct_answer
  - statistics
```

### Livewire Components / Komponen Livewire
```php
// Participant components
JoinCompetition:
  - Enter room code / Masukkan kode ruangan
  - Validate and join / Validasi dan gabung
  
BuzzerButton:
  - Real-time buzzer / Buzzer real-time
  - Visual feedback / Umpan balik visual
  - Disable after first buzz / Nonaktifkan setelah buzz pertama
  
QuestionDisplay:
  - Show current question / Tampilkan pertanyaan saat ini
  - Timer countdown / Hitung mundur timer
  - Answer options / Opsi jawaban

ParticipantScoreboard:
  - Live scores / Skor langsung
  - Personal ranking / Peringkat personal
  - Competition progress / Progres kompetisi

// Host components  
HostControlPanel:
  - Start/pause/next question / Mulai/pause/pertanyaan berikutnya
  - Participant management / Manajemen peserta
  - Real-time monitoring / Monitoring real-time
  
HostScoreboard:
  - Complete participant scores / Skor peserta lengkap
  - Question statistics / Statistik pertanyaan
  - Competition analytics / Analitik kompetisi

CompetitionSetup:
  - Create room / Buat ruangan
  - Select questions / Pilih pertanyaan
  - Configure settings / Konfigurasi pengaturan
```

### Pusher Configuration / Konfigurasi Pusher
```env
# Required environment variables
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key  
PUSHER_APP_SECRET=your_app_secret
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

BROADCAST_DRIVER=pusher
```

---

## Phase 5: Admin Panel 🔧
**Status:** PLANNED / DIRENCANAKAN  
**Dependencies:** Phase 4 complete / Fase 4 selesai

### Goals / Tujuan
Comprehensive admin interface using Filament 3 for content and user management.

*Interface admin komprehensif menggunakan Filament 3 untuk manajemen konten dan pengguna.*

### Filament Resources / Resource Filament
```php
// Content Management
QuestionResource:
  - CRUD operations / Operasi CRUD
  - Bulk import/export / Import/export massal
  - Category filtering / Filter kategori
  - Preview functionality / Fungsi pratinjau

CategoryResource:
  - Category management / Manajemen kategori
  - Color coding / Kode warna
  - Question statistics / Statistik pertanyaan

// Competition Management
CompetitionResource:
  - Competition CRUD / CRUD kompetisi
  - Participant management / Manajemen peserta
  - Real-time monitoring / Monitoring real-time
  - Result export / Export hasil

// User Management
UserResource:
  - User CRUD / CRUD pengguna
  - Role assignment / Penugasan peran
  - Activity tracking / Pelacakan aktivitas

// Analytics
AnalyticsResource:
  - Competition statistics / Statistik kompetisi
  - User engagement metrics / Metrik keterlibatan pengguna
  - Performance reports / Laporan kinerja
```

### Admin Dashboard Widgets / Widget Dashboard Admin
- Competition statistics / Statistik kompetisi
- Active users chart / Grafik pengguna aktif
- Question bank status / Status bank soal
- System health monitoring / Monitoring kesehatan sistem

### Role-based Permissions / Izin Berbasis Peran
```php
Roles & Permissions:
  
Super Admin:
  - Full system access / Akses sistem penuh
  - User management / Manajemen pengguna
  - System configuration / Konfigurasi sistem
  
Content Manager:
  - Question bank management / Manajemen bank soal
  - Category management / Manajemen kategori
  - Content moderation / Moderasi konten
  
Competition Host:
  - Create competitions / Membuat kompetisi
  - Manage own competitions / Mengelola kompetisi sendiri
  - View participant data / Melihat data peserta
  
Participant:
  - Join competitions / Bergabung kompetisi
  - View own scores / Melihat skor sendiri
  - Basic profile management / Manajemen profil dasar
```

---

## Phase 6: Polish & Production 🎨
**Status:** PLANNED / DIRENCANAKAN  
**Dependencies:** Phase 5 complete / Fase 5 selesai

### Goals / Tujuan
Final improvements, optimization, and production deployment preparation.

*Peningkatan akhir, optimisasi, dan persiapan deployment produksi.*

### Performance Optimization / Optimisasi Kinerja
- [ ] Database query optimization / Optimisasi query database
- [ ] Redis caching implementation / Implementasi caching Redis
- [ ] CDN setup for assets / Setup CDN untuk aset
- [ ] Image optimization / Optimisasi gambar
- [ ] Lazy loading components / Komponen lazy loading

### UI/UX Improvements / Peningkatan UI/UX
- [ ] Mobile-first responsive design / Desain responsif mobile-first
- [ ] Accessibility (WCAG 2.1) compliance / Kepatuhan aksesibilitas
- [ ] Progressive Web App (PWA) features / Fitur Progressive Web App
- [ ] Dark mode support / Dukungan dark mode
- [ ] Multi-language support (Indonesian/English) / Dukungan multi-bahasa

### Production Readiness / Kesiapan Produksi
- [ ] Docker containerization / Kontainerisasi Docker
- [ ] CI/CD pipeline with tests / Pipeline CI/CD dengan test
- [ ] Environment-specific configurations / Konfigurasi spesifik environment
- [ ] Monitoring and logging setup / Setup monitoring dan logging
- [ ] Backup strategies / Strategi backup

### Documentation / Dokumentasi
- [ ] API documentation / Dokumentasi API
- [ ] Deployment guide / Panduan deployment
- [ ] User manual / Manual pengguna
- [ ] Administrator guide / Panduan administrator
- [ ] Troubleshooting guide / Panduan pemecahan masalah

---

## Anti-Blocking Strategies / Strategi Anti-Blokir

### Network-Free CI Approach / Pendekatan CI Bebas Jaringan
```yaml
# Strategy for each phase
Phase 1: Validate structure, skip composer install
Phase 2: Check files exist, skip npm install  
Phase 3: Validate migrations, skip database operations
Phase 4: Test event classes, skip Pusher connections
Phase 5: Validate Filament setup, skip admin seeding
Phase 6: Run local tests only, skip external services
```

### Development Environment / Environment Pengembangan
- Use local services (SQLite, local Redis) / Gunakan layanan lokal
- Mock external services for testing / Mock layanan eksternal untuk testing
- Provide Docker Compose for consistent setup / Sediakan Docker Compose untuk setup konsisten
- Clear documentation for service alternatives / Dokumentasi jelas untuk alternatif layanan

---

## Success Metrics / Metrik Keberhasilan

### Technical Metrics / Metrik Teknis
- [ ] 100% green CI on all PRs / 100% CI hijau di semua PR
- [ ] Sub-100ms buzzer response time / Waktu respons buzzer sub-100ms
- [ ] Support 50+ concurrent participants / Dukungan 50+ peserta bersamaan
- [ ] 99.9% uptime / 99.9% uptime

### User Experience Metrics / Metrik Pengalaman Pengguna  
- [ ] Mobile-responsive on all screen sizes / Responsif mobile di semua ukuran layar
- [ ] Intuitive user interface / Interface pengguna intuitif
- [ ] Comprehensive admin panel / Panel admin komprehensif
- [ ] Multi-language support / Dukungan multi-bahasa

### Business Metrics / Metrik Bisnis
- [ ] Easy competition setup (< 5 minutes) / Setup kompetisi mudah (< 5 menit)
- [ ] Scalable architecture / Arsitektur scalable
- [ ] Production-ready deployment / Deployment siap produksi
- [ ] Comprehensive documentation / Dokumentasi komprehensif

---

## Notes for Contributors / Catatan untuk Kontributor

### Important Reminders / Pengingat Penting
1. **No network dependencies in CI** / Tidak ada dependensi jaringan di CI
2. **Preserve legacy quiz functionality** / Pertahankan fungsi quiz lama
3. **Follow established coding standards** / Ikuti standar coding yang ditetapkan
4. **Write tests for new features** / Tulis test untuk fitur baru
5. **Update documentation with changes** / Update dokumentasi dengan perubahan

### Getting Help / Mendapat Bantuan
- Check existing issues and discussions / Periksa issue dan diskusi yang ada
- Follow CONTRIBUTING.md guidelines / Ikuti panduan CONTRIBUTING.md
- Use descriptive commit messages / Gunakan pesan commit yang deskriptif
- Test changes locally before PR / Test perubahan secara lokal sebelum PR

---

*Last updated: Current PR*  
*Terakhir diupdate: PR Saat Ini*