Yazan:Arda Altun
Tarih:16.04.2025
# Laravel Blog API

Laravel Blog API, JWT (JSON Web Token) tabanlı kimlik doğrulama sistemi kullanan, kullanıcıların kayıt olup blog yazıları oluşturabileceği, düzenleyebileceği ve silebileceği bir RESTful API projesidir.

##  Proje Özellikleri

- **Laravel 10.x** ile geliştirilmiştir
- **JWT (JSON Web Token)** ile güvenli kimlik doğrulama
- Blog yazıları için **CRUD** (Create, Read, Update, Delete) işlemleri
- RESTful API tasarım prensiplerine uygun geliştirme
- MySQL veritabanı kullanımı
- İlişkisel veritabanı tasarımı (Kullanıcı-Blog yazısı ilişkisi)
- Detaylı API belgelendirmesi için Postman koleksiyonu

##  Kurulum

### Gereksinimler
- PHP 8.1+
- Composer
- MySQL
- XAMPP, WAMP, MAMP veya Laravel Sail (Docker)

### Adımlar

```bash
# Projeyi klonlayın
git clone [repo-url]

# Proje klasörüne girin
cd laravelblog

# Bağımlılıkları yükleyin
composer install

# .env dosyasını oluşturun
cp .env.example .env

# Veritabanı bağlantısını ayarlayın (.env dosyasında)
# DB_DATABASE=laravelblog
# DB_USERNAME=root
# DB_PASSWORD=

# Uygulama anahtarını oluşturun
php artisan key:generate

# JWT anahtar oluşturun
php artisan jwt:secret

# Veritabanı tablolarını oluşturun
php artisan migrate

# Geliştirme sunucusunu başlatın
php artisan serve
```

##  API Endpoints

### Kimlik Doğrulama (Auth)

| Endpoint | Metot | Açıklama | Kimlik Doğrulama |
|----------|-------|----------|-----------------|
| `/api/auth/register` | POST | Yeni kullanıcı kaydı | Hayır |
| `/api/auth/login` | POST | Kullanıcı girişi | Hayır |
| `/api/auth/logout` | POST | Kullanıcı çıkışı | Evet |
| `/api/auth/me` | GET | Kullanıcı profilini görüntüleme | Evet |

### Blog Yazıları (Posts)

| Endpoint | Metot | Açıklama | Kimlik Doğrulama |
|----------|-------|----------|-----------------|
| `/api/posts` | GET | Tüm yazıları listeleme | Hayır |
| `/api/posts` | POST | Yeni yazı oluşturma | Evet |
| `/api/posts/{id}` | GET | Belirli bir yazıyı görüntüleme | Hayır |
| `/api/posts/{id}` | PUT | Yazı güncelleme | Evet (Sadece yazı sahibi) |
| `/api/posts/{id}` | DELETE | Yazı silme | Evet (Sadece yazı sahibi) |

##  Veri Modelleri

### User
- `id`: int, primary key
- `name`: string
- `email`: string, unique
- `password`: string (hashed)
- `created_at`: timestamp
- `updated_at`: timestamp

### Post
- `id`: int, primary key
- `user_id`: int, foreign key
- `title`: string
- `content`: text
- `created_at`: timestamp
- `updated_at`: timestamp

##  API Kullanımı

### Örnek İstekler

#### Kullanıcı Kaydı
```json
POST /api/auth/register
Content-Type: application/json

{
  "name": "Test Kullanıcı",
  "email": "test@example.com",
  "password": "123456"
}
```

#### Kullanıcı Girişi
```json
POST /api/auth/login
Content-Type: application/json

{
  "email": "test@example.com",
  "password": "123456"
}
```

#### Blog Yazısı Oluşturma
```json
POST /api/posts
Content-Type: application/json
Authorization: Bearer {token}

{
  "title": "İlk Blog Yazım",
  "content": "Bu bir test içeriğidir."
}
```

##  Kimlik Doğrulama

API, JWT tabanlı bir kimlik doğrulama sistemi kullanır:

1. Kullanıcı kaydı veya girişi yapın
2. Dönen JWT token'ı alın
3. Korunan API endpoint'lerine istek yaparken Authorization header'ında token'ı gönderin:
   `Authorization: Bearer {token}`

##  Postman Koleksiyonu

API'yi test etmek için bir Postman koleksiyonu hazırlanmıştır. Bu koleksiyon:

- Tüm API endpoint'lerini içerir
- Otomatik token yönetimi için test script'leri içerir
- API'yi kapsamlı bir şekilde test etmenizi sağlar

Koleksiyonu şuradan indirebilirsiniz: `postman\Laravel Blog API.postman_collection.json`

##  Notlar

- JWT token'ları 1 saat süreyle geçerlidir
- Blog yazılarını yalnızca giriş yapmış kullanıcılar oluşturabilir
- Bir yazıyı yalnızca o yazıyı oluşturan kullanıcı düzenleyebilir veya silebilir

##  Kullanılan Teknolojiler

- Laravel 10.x
- tymon/jwt-auth 2.0
- MySQL
- RESTful API

##  Proje Yapısı

- `app/Http/Controllers/API/AuthController.php`: Kimlik doğrulama işlemlerini yönetir
- `app/Http/Controllers/API/PostController.php`: Blog yazısı işlemlerini yönetir
- `app/Models/User.php`: Kullanıcı modeli (JWT entegrasyonu içerir)
- `app/Models/Post.php`: Blog yazısı modeli
- `routes/api.php`: API rotalarını tanımlar
- `config/auth.php`: Kimlik doğrulama yapılandırması
- `config/jwt.php`: JWT yapılandırması
