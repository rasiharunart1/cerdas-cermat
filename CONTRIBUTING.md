# Contributing to Cerdas Cermat / Berkontribusi ke Cerdas Cermat

## Welcome / Selamat Datang! 👋

**English:** Thank you for your interest in contributing to our real-time quiz buzzer system! This guide will help you get started.

**Bahasa Indonesia:** Terima kasih atas minat Anda untuk berkontribusi pada sistem buzzer quiz real-time kami! Panduan ini akan membantu Anda memulai.

## Branch Strategy / Strategi Branch

### Main Branches / Branch Utama
- `main` - Production-ready code / *Kode siap produksi*
- `develop` - Integration branch for features / *Branch integrasi untuk fitur*

### Feature Branches / Branch Fitur
- Create feature branches from `develop` / *Buat branch fitur dari `develop`*
- Naming convention: `feature/brief-description` / *Konvensi penamaan: `feature/deskripsi-singkat`*
- Examples / *Contoh*:
  - `feature/buzzer-system`
  - `feature/admin-panel`
  - `feature/real-time-scoring`

### Bug Fix Branches / Branch Perbaikan Bug
- Create from `main` for hotfixes / *Buat dari `main` untuk hotfix*
- Create from `develop` for regular bugs / *Buat dari `develop` untuk bug biasa*
- Naming: `bugfix/issue-description` / *Penamaan: `bugfix/deskripsi-masalah`*

## Development Workflow / Alur Kerja Development

### 1. Before Starting / Sebelum Memulai
```bash
# Clone the repository
git clone https://github.com/rasiharunart1/cerdas-cermat.git
cd cerdas-cermat

# Create feature branch
git checkout develop
git pull origin develop
git checkout -b feature/your-feature-name
```

### 2. During Development / Selama Development
- Write clear, descriptive commit messages / *Tulis pesan commit yang jelas dan deskriptif*
- Test your changes locally / *Test perubahan Anda secara lokal*
- Follow coding standards / *Ikuti standar coding*

### 3. Before Submitting PR / Sebelum Submit PR
```bash
# Sync with latest develop
git checkout develop
git pull origin develop
git checkout feature/your-feature-name
git rebase develop

# Run tests (when available)
composer test  # PHP tests
npm test       # JavaScript tests

# Run linting (when available)
composer lint  # PHP linting
npm run lint   # JavaScript linting
```

## Commit Message Style / Gaya Pesan Commit

### Format
```
type(scope): description

[optional body]

[optional footer]
```

### Types / Jenis
- `feat` - New feature / *Fitur baru*
- `fix` - Bug fix / *Perbaikan bug*
- `docs` - Documentation / *Dokumentasi*
- `style` - Code style changes / *Perubahan gaya kode*
- `refactor` - Code refactoring / *Refaktoring kode*
- `test` - Adding tests / *Menambah test*
- `chore` - Maintenance tasks / *Tugas maintenance*

### Examples / Contoh
```
feat(buzzer): add real-time buzzer system
fix(auth): resolve login redirect issue
docs(readme): update installation instructions
style(css): improve mobile responsiveness
```

## Code Style Guidelines / Panduan Gaya Kode

### PHP (Laravel)
- Follow PSR-12 coding standard / *Ikuti standar coding PSR-12*
- Use meaningful variable and method names / *Gunakan nama variabel dan method yang bermakna*
- Write docblocks for classes and methods / *Tulis docblock untuk kelas dan method*
- Use type hints where possible / *Gunakan type hint jika memungkinkan*

### JavaScript (Livewire/Alpine.js)
- Use ES6+ features / *Gunakan fitur ES6+*
- Follow consistent indentation (2 spaces) / *Ikuti indentasi konsisten (2 spasi)*
- Use meaningful variable names / *Gunakan nama variabel yang bermakna*
- Add comments for complex logic / *Tambahkan komentar untuk logika kompleks*

### Database
- Use descriptive table and column names / *Gunakan nama tabel dan kolom yang deskriptif*
- Follow Laravel naming conventions / *Ikuti konvensi penamaan Laravel*
- Add appropriate indexes / *Tambahkan index yang sesuai*
- Write migration rollbacks / *Tulis rollback migrasi*

## Environment Secrets / Rahasia Environment

### Local Development / Development Lokal
- Copy `.env.example` to `.env` / *Copy `.env.example` ke `.env`*
- Never commit `.env` files / *Jangan pernah commit file `.env`*
- Use local database credentials / *Gunakan kredensial database lokal*

### Sensitive Information / Informasi Sensitif
**⚠️ NEVER commit these / JANGAN PERNAH commit ini:**
- API keys / *Kunci API*
- Database passwords / *Password database*
- Pusher credentials / *Kredensial Pusher*
- Production environment variables / *Variabel environment produksi*

### Required Environment Variables / Variabel Environment yang Diperlukan
```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cerdas_cermat
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Pusher (for real-time features)
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_key
PUSHER_APP_SECRET=your_pusher_secret
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1
```

## Pull Request Process / Proses Pull Request

### Before Creating PR / Sebelum Membuat PR
1. Ensure all tests pass / *Pastikan semua test lulus*
2. Update documentation if needed / *Update dokumentasi jika diperlukan*
3. Add screenshots for UI changes / *Tambahkan screenshot untuk perubahan UI*
4. Write clear PR description / *Tulis deskripsi PR yang jelas*

### PR Review Process / Proses Review PR
1. Automated checks must pass / *Pengecekan otomatis harus lulus*
2. At least one code review required / *Minimal satu review kode diperlukan*
3. Address review feedback / *Tangani feedback review*
4. Squash and merge when approved / *Squash dan merge ketika disetujui*

## Getting Help / Mendapat Bantuan

### Questions / Pertanyaan
- Open an issue with `question` label / *Buka issue dengan label `question`*
- Join our discussion board / *Bergabung dengan papan diskusi kami*
- Check existing documentation / *Periksa dokumentasi yang ada*

### Found a Bug? / Menemukan Bug?
- Check existing issues first / *Periksa issue yang ada terlebih dahulu*
- Use the bug report template / *Gunakan template laporan bug*
- Provide reproduction steps / *Berikan langkah reproduksi*
- Include environment details / *Sertakan detail environment*

## Code of Conduct / Kode Etik

### Be Respectful / Bersikap Hormat
- Use inclusive language / *Gunakan bahasa yang inklusif*
- Respect different viewpoints / *Hormati sudut pandang yang berbeda*
- Be constructive in feedback / *Bersikap konstruktif dalam feedback*

### Be Collaborative / Bersikap Kolaboratif
- Help others learn / *Bantu orang lain belajar*
- Share knowledge freely / *Bagikan pengetahuan dengan bebas*
- Welcome newcomers / *Sambut pendatang baru*

## Thank You! / Terima Kasih!

Your contributions help make this project better for everyone. We appreciate your time and effort!

*Kontribusi Anda membantu membuat proyek ini lebih baik untuk semua orang. Kami menghargai waktu dan usaha Anda!*