# Sistem Informasi Manajemen Data Mahasiswa (PHP + MySQL)

## Cara menjalankan (Laragon)
1. Salin folder ini ke `C:\laragon\www\crud_mahasiswa`
2. Start All di Laragon
3. Buka HeidiSQL / phpMyAdmin, jalankan isi `database.sql`
4. Buka http://localhost/crud_mahasiswa
5. Login: `admin` / `admin123`

## Fitur
- CRUD data mahasiswa (prepared statement)
- Validasi (if-else/switch) + sanitasi (htmlspecialchars, filter_var)
- Login berbasis $_SESSION
- Dua bahasa (ID/EN) disimpan di $_SESSION
