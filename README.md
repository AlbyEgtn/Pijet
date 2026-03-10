# Laravel Project Collaboration Guide

Panduan ini menjelaskan workflow Git untuk mengerjakan project Laravel oleh **2 developer** menggunakan sistem **branch per feature / halaman**.

---

# 1. Struktur Branch

Repository menggunakan struktur branch berikut:

```
main
 ├── feature-auth
 ├── feature-dashboard
 ├── feature-product
 └── feature-order
```

Penjelasan:

* **main** → branch utama (kode stabil / production ready)
* **feature-*** → branch khusus untuk mengerjakan halaman atau fitur tertentu

Contoh pembagian kerja:

| Developer | Feature                          | Branch            |
| --------- | -------------------------------- | ----------------- |
| Dev 1     | Authentication (login, register) | feature-auth      |
| Dev 2     | Dashboard                        | feature-dashboard |

---

# 2. Setup Project

Clone repository:

```
git clone https://github.com/username/project-name.git
cd project-name
```

Install dependency Laravel:

```
composer install
```

Copy environment file:

```
cp .env.example .env
```

Generate key:

```
php artisan key:generate
```

Jalankan migration:

```
php artisan migrate
```

Jalankan server:

```
php artisan serve
```

---

# 3. Workflow Development

Setiap developer bekerja pada **branch masing-masing**.

### 1. Ambil branch terbaru

```
git checkout main
git pull origin main
```

### 2. Buat branch feature

```
git checkout -b feature-auth
```

atau

```
git checkout -b feature-dashboard
```

---

# 4. Proses Development

Setelah melakukan perubahan:

### Stage perubahan

```
git add .
```

### Commit perubahan

```
git commit -m "Add login page"
```

### Push ke repository

```
git push origin feature-
```

---

# 5. Pull Request

Setelah fitur selesai:

1. Buka repository di **GitHub**
2. Pilih **Pull Request**
3. Pilih branch:

```
feature-auth → main
```

4. Klik **Create Pull Request**

Pull request akan direview sebelum digabungkan ke branch **main**.

---

# 6. Merge Pull Request

Jika fitur sudah benar:

1. Review code
2. Klik **Merge Pull Request**
3. Delete branch jika sudah tidak digunakan

---

# 7. Update Project Setelah Merge

Developer lain harus update project:

```
git checkout main
git pull origin main
```

Jika ingin melanjutkan feature lain:

```
git checkout -b feature-product
```

---

# 8. Best Practice

Beberapa praktik yang disarankan:

* Gunakan **1 branch = 1 feature**
* Jangan langsung commit ke **main**
* Gunakan commit message yang jelas
* Selalu **pull main sebelum membuat branch baru**
* Hindari branch yang terlalu lama tidak di merge

Contoh commit message yang baik:

```
Add login validation
Create dashboard layout
Fix product pagination
```

---

# 9. Contoh Pembagian Halaman

Contoh pembagian kerja:

| Feature          | Branch            | Developer |
| ---------------- | ----------------- | --------- |
| Login & Register | feature-auth      | Dev 1     |
| Dashboard        | feature-dashboard | Dev 2     |
| Product CRUD     | feature-product   | Dev 1     |
| Order Management | feature-order     | Dev 2     |

---

# 10. Teknologi

Project ini menggunakan:

* Laravel
* MySQL
* TailwindCSS
* Vite
* Git & GitHub

---

# 11. Catatan

Workflow ini cocok untuk:

* Team kecil (2–4 developer)
* Project tugas kuliah
* Prototype atau MVP

Jika project semakin besar, workflow dapat dikembangkan menggunakan **Git Flow** atau **Trunk Based Development**.

---

**Author**

Developed collaboratively by the project team.
