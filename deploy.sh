#!/bin/bash
echo "🚀 Memulai proses deployment SIPEGAN ke Production VPS..."

# 1. Pastikan dependensi terinstall
echo "📦 Menginstall dependensi PHP (tanpa paket development)..."
composer install --optimize-autoloader --no-dev

echo "📦 Menginstall dependensi Node.js dan kompilasi aset..."
npm install
npm run build

# 2. Sinkronisasi Database (Hati-hati: gunakan --force agar tidak ditanya interaktif di VPS)
echo "🗄️ Menjalankan migrasi database..."
php artisan migrate --force

# 3. Menghubungkan Storage untuk dokumen pendaftaran
echo "🔗 Membuat link folder storage (untuk file PDF)..."
php artisan storage:link

# 4. Membersihkan & Mengoptimalkan Cache Laravel
echo "🧹 Membersihkan cache lama..."
php artisan optimize:clear

echo "⚡ Mengoptimalkan route, config, dan views..."
php artisan optimize

# 5. Memperbaiki Permission (Pastikan script ini dijalankan dengan akses yang tepat / sudo jika perlu)
echo "🔒 Mengatur hak akses folder storage dan cache..."
# Chmod 775 memberikan hak baca, tulis, eksekusi untuk user dan group
chmod -R 775 storage bootstrap/cache

echo "✅ SIPEGAN berhasil di-deploy ke Production! Aplikasi siap digunakan."
