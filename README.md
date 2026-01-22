# 📺 Laravel YouTube Clone

![Laravel](https://img.shields.io/badge/Laravel-10-red)
![Vue](https://img.shields.io/badge/Vue-3-green)
![Inertia](https://img.shields.io/badge/Inertia.js-enabled-purple)
![Tailwind](https://img.shields.io/badge/TailwindCSS-3-blue)
![License](https://img.shields.io/badge/license-MIT-success)

A lightweight **YouTube-style video sharing platform** built with **Laravel**, **Inertia.js**, and **Vue 3**.  
Designed for learning, prototyping, and small-scale production use.

✨ Automatic thumbnail generation using **FFmpeg**  
✨ Responsive, modern UI inspired by YouTube  
✨ Clean Laravel architecture

---

## 📸 Screenshots

> _(Add screenshots here)_

```
/screenshots
 ├── home.png
 ├── upload.png
 └── preview-hover.gif
```

---

## 🚀 Features

- 🎬 Video upload (MP4 & QuickTime)
- 🖼️ Auto-thumbnail generation at 1-second mark
- 📱 Fully responsive video grid (Tailwind CSS)
- ▶️ Hover-to-play video preview
- 🗂️ Organized storage for videos & thumbnails
- ⚡ Fast SPA experience with Inertia.js

---

## 🛠️ Tech Stack

- **Backend:** Laravel 10+, PHP 8.2
- **Frontend:** Vue 3, Inertia.js
- **Styling:** Tailwind CSS
- **Video Processing:** FFmpeg
- **Database:** SQLite / MySQL
- **Build Tool:** Vite

---

## 📦 Installation

### 1️⃣ Clone Repository

```bash
git clone https://github.com/your-username/youtube-clone.git
cd youtube-clone
```

### 2️⃣ Install Dependencies

```bash
composer install
npm install
```

### 3️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

> Configure database credentials in `.env`

---

## 🎞️ FFmpeg Setup (Windows)

Install FFmpeg using WinGet:

```bash
winget install Gyan.FFmpeg
```

Update `VideoController.php`:

```php
'ffmpeg.binaries'  => 'C:/ffmpeg/bin/ffmpeg.exe',
'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
```

---

## 📂 Storage Setup

```bash
php artisan storage:link
```

**Windows Permission Fix (Run as Admin):**

```powershell
icacls "storage/app/public" /grant "Everyone:(OI)(CI)F" /T
```

---

## 🗄️ Database Migration

```bash
php artisan migrate
```

---

## ▶️ Run the Application

### Start Frontend

```bash
npm run dev
```

### Start Backend

```bash
php artisan serve
```

🌐 Visit: http://localhost:8000

---

## 🛠️ Artisan Commands

| Command | Description |
|------|------------|
| `php artisan videos:clear-all` | Deletes all videos & thumbnails |
| `php artisan videos:fix-thumbnails` | Regenerates missing thumbnails |
| `php artisan optimize:clear` | Clears application cache |

---

## 📁 Project Structure

```
app/
 └── Http/Controllers/VideoController.php
resources/
 └── js/Pages/Welcome.vue
storage/app/public/
 ├── videos/
 └── thumbnails/
```

---

## 🧪 Testing (Optional)

```bash
php artisan test
```

---

## 🚀 Deployment Notes

- Run `npm run build` for production assets
- Set `APP_ENV=production`
- Set correct FFmpeg paths on server
- Use Supervisor for queue workers (if added)

---

## 📜 License

Licensed under the **MIT License**  
Feel free to use, modify, and distribute.

---

## ⭐ Support

If this project helped you, consider giving it a ⭐ on GitHub!
