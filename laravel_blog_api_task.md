## Laravel Blog API Task

### 🔍 Proje Özeti
Amaç, Laravel kullanarak JWT tabanlı güvenliğe sahip, CRUD işlemlerini içeren **basit bir blog API** sistemi oluşturmaktır. Kod okunabilirliği, yazılım mimarisi, veritabanı tasarımı ve API kullanımı kriterlerine göre değerlendirilecektir.

---

### ✅ Gereksinimler

#### 1. Kullanıcı İşlemleri
- **Kayıt (`POST /api/register`)**
  - `name`, `email`, `password` alanları
  - `email` unique olmalı
  - Şifre bcrypt ile hashlenmeli

- **Giriş (`POST /api/login`)**
  - `email`, `password`
  - Başarılı giriş sonrası JWT token döndürülmeli

- **Middleware**
  - `auth:api` veya JWT middleware ile korunan rotalar

---

#### 2. Blog Gönderisi İşlemleri
- **Oluştur (`POST /api/posts`)**
  - `title`, `content`
  - Auth ile sadece giriş yapmış kullanıcı oluşturabilir
- **Listele (`GET /api/posts`)**
  - Tüm gönderileri getir
- **Detay (`GET /api/posts/{id}`)**
  - Belirli gönderiyi getir
- **Güncelle (`PUT /api/posts/{id}`)**
  - Sadece gönderi sahibi güncelleyebilir
- **Sil (`DELETE /api/posts/{id}`)**
  - Sadece gönderi sahibi silebilir

---

### 🧱 Veritabanı Tasarımı (MySQL)

#### Tablo: `users`
```sql
id, name, email (unique), password, timestamps
```

#### Tablo: `posts`
```sql
id, user_id (foreign key), title, content, timestamps
```

---

### 📦 API Örnek Yapısı (JSON)

#### Register Request
```json
POST /api/register
{
  "name": "Arda",
  "email": "arda@example.com",
  "password": "123456"
}
```

#### Login Response
```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGci..."
}
```

#### Post Oluşturma
```json
POST /api/posts
Authorization: Bearer {token}
{
  "title": "Blog Başlığı",
  "content": "İçerik yazısı burada yer alır."
}
```

---

### 🧪 Test & Postman

- Her endpoint için başarılı ve başarısız örnekler içeren bir **Postman koleksiyonu** hazırlanmalı
- Authorization header unutulmamalı
- `.json` olarak dışa aktarılmalı

---

### 🧠 Değerlendirme Kriterleri

| Kriter                    | Açıklama |
|--------------------------|----------|
| ✅ Kod okunabilirliği     | Kısa, yorumlu, sade kod |
| ✅ Yazılım mimarisi       | Katmanlı yapı, controller/service separation (opsiyonel ama avantaj sağlar) |
| ✅ Veritabanı tasarımı    | Doğru ilişkilendirme ve field yapısı |
| ✅ API kullanımı          | RESTful ilkelere uygunluk |
| ✅ Proje bütünlüğü        | Çalışan ve net test edilebilir API |

---
