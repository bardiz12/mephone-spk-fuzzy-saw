# MePhone - Sistem Pendukung Keputusan Pemilihan Handphone menggunakan Metode Fuzzy Simple Additive Weighting (SAW)

![SS](https://user-images.githubusercontent.com/25524265/68142817-bd573e00-ff62-11e9-969b-29ccd0d252d9.png)
Project ini dibuat pada saat saya semester 3 untuk memenuhi tugas Logika Fuzzy. Project ini dibuat menggunakan Framework Codeigniter (CI) dan Library Blade views dari Laravel.


## Features
* Input HP
* Pilihan Aspek yang digunakan untuk pembobotan (ukuran RAM, ukuran Memori, Ukuran Layar,dll.)
* Pembobotan menggunakan SAW
* Tampilan Table Perhitungan Matematis-nya.


## Instalation
### Manual Installation
1. Download project ini melalui zip, atau dengan clone :
    ```bash
    git clone https://github.com/bardiz12/mephone-spk-fuzzy-saw.git
    ```
2.  Buka file __application/config/database.php__, dan ganti sesuai pengaturan database anda.
    ```php
    $db['default'] = array(
        'dsn'	=> '',
        'hostname' => 'localhost:3307',
        'username' => 'root',
        'password' => 'indomie',
        'database' => 'hp',
        'dbdriver' => 'mysqli',
    ```
3. sesuaikan URL aplikasi di file __application/config/config.php__ 
    ```php
    $config['base_url'] = 'http://URL-ANDA';
    ```

4. import file db.sql ke DBMS MYSQL anda
5. Update Library yang dibutuhkan dengan Composer:
    ```bash
    composer update
    ```

6. Jalankan Server<br/>
    Jika menggunakan XAMPP/LAMP atau sejenisnya tinggal buka: 
    ```
    http://localhost/folder_project/public/
    ```
    atau jika ingin menggunakan __PHP BUILTIN SERVER__, gunakan command berikut:
    ```bash
    php -S 127.0.0.1:8080 -t public/
    ```
    _nb: ganti port 8080 bisa anda ganti sesuai keinginan anda_

### Docker Installation
Start docker configuration
```bash
docker-compose up -d
docker-compose exec app bash
```
Inside container
```bash
composer run app-init
php index.php migrate
```
Open on browser 
- [http://localhost:8123/](http://localhost:8123/)

## Screenshot
1. <a href="https://user-images.githubusercontent.com/25524265/68142817-bd573e00-ff62-11e9-969b-29ccd0d252d9.png" target="_blank">Tampilan awal</a>
2. <a href="https://user-images.githubusercontent.com/25524265/68142900-e7a8fb80-ff62-11e9-9b65-428c94befd44.png" target="_blank">Tampilan penentuan bobot preferensi</a>
3. <a href="https://user-images.githubusercontent.com/25524265/68141716-9e57ac80-ff60-11e9-992f-9bc9ede86f26.png" target="_blank">Tampilan Hasil Rekomendasi</a>

## DEMO
### <a href="https://mephone.herokuapp.com/">https://mephone.herokuapp.com/</a>