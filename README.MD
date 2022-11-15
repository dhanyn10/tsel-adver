# Tsel

## Petunjuk Instalasi
### Tanpa Docker
1. install packages yang dibutuhkan laravel dengan command `composer install`
2. buat database `data_form` di phpmyadmin
3. jalankan fitur autogenerate tabel dengan command `php artisan migrate`
4. jalankan fitur autofill data dummy dengan command `php artisan db:seed`
5. jalankan apps dengan command `php artisan serve`

### Dengan Docker
1. ganti isi file `.env` dengan `.env.docker`
2. build apps dengan command `docker-compose up -d`
3. tunggu selama >= 10 detik
4. gunakan command `docker exec tsel-web composer dump-autoload` agar configurasi `.env` dapat dibaca sistem
5. gunakan command `docker exec tsel-web php artisan migrate` untuk autogenerate tabel
6. gunakan command `docker exec tsel-web php artisan db:seed` untuk mengisi tabel dengan data dummy

## Petunjuk Penggunaan
- halaman register untuk memasukkan data user baru. Contoh data adalah sebagai berikut:
    ```
    nama: hello
    email: hello@example.com
    telepon: 808080808080
    ```
    jika berhasil, seharusnya mendapatkan respon popup Thankyou!
- halaman login untuk tes login dengan data user yang sudah ada menggunakan data email. Contoh data adalah email: `hello@example.com`. Jika berhasil, seharusnya mendapatkan respon popup Thankyou!. Saat gagal login, lalu berhasil login kembali dengan email yang terdaftar di database, maka riwayat kegagalan terakhir terekam di cookie pada dasbor.

### Rest API
- GET data semua user. Pada postman, pilih method GET dengan alamat `localhost:8000/api/users`
- GET data user tertentu berdasarkan id. Pada postman, pilih method GET dengan alamat `localhost:8000/api/users/1` untuk melihat data user dengan `id=1`
- Menambah data baru. Pada postman, pilih method POST dengan alamat `localhost:8000/api/users`, lalu pilih `Body > raw > JSON` dan masukkan data berikut(sebagai contoh)
    ```json
    {
        "nama": "merdeka",
        "email": "pusaka@jogja.id",
        "telepon": 945637295015
    }
    ```
- Mengubah/update data. Pada postman, pilih method PUT dengan alamat `localhost:8000/api/users/15` untuk mengubah data dengan `id=13`, lalu pilih `Body > raw > JSON` dan masukkan data berikut(sebagai contoh)
    ```json
    {
        "nama": "Arslan",
        "email": "sword@arslan.senki",
        "telepon": 141414141414
    }
    ```
- Menghapus/delete data. Pada postman, pilih method DELETE dengan `localhost:8000/api/users/15` untuk menghapus data dengan `id=13`(sebagai contoh)