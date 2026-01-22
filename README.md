
📺 Laravel YouTube Clone
A lightweight YouTube-style video sharing platform built with Laravel, Inertia.js, and Vue 3. This project features automatic thumbnail generation using FFmpeg and a responsive video grid layout.

🚀 Features
Video Upload: Support for MP4 and QuickTime formats.

Auto-Thumbnail Generation: Automatically extracts a frame at the 1-second mark using FFmpeg.

Responsive Grid: YouTube-style homepage layout using Tailwind CSS.

Video Preview: Hover-to-play functionality on video thumbnails.

Dedicated Storage: Managed file system for videos and generated images.

🛠️ Prerequisites
PHP 8.2+

Composer

Node.js & NPM

FFmpeg: Must be installed on the system (see Installation section).

SQLite/MySQL: Database for storing video metadata.

 Installation1. Clone the repositoryBashgit clone https://github.com/your-username/youtube-clone.git
cd youtube-clone
2. Install DependenciesBashcomposer install
npm install
3. Environment SetupCopy the example environment file and generate an app key:Bashcp .env.example .env
php artisan key:generate
Note: Ensure DB_DATABASE is configured in your .env.4. FFmpeg Configuration (Windows)This project requires FFmpeg and FFProbe binaries.Install via WinGet: winget install Gyan.FFmpegUpdate VideoController.php with your absolute paths:PHP'ffmpeg.binaries'  => 'C:/path/to/ffmpeg.exe',
'ffprobe.binaries' => 'C:/path/to/ffprobe.exe',
5. Storage Link & PermissionsCreate the symbolic link to make files accessible via the web:Bashphp artisan storage:link
If you encounter permission issues on Windows, run the following in PowerShell as Admin:PowerShellicacls "storage/app/public" /grant "Everyone:(OI)(CI)F" /T
6. Database MigrationBashphp artisan migrate
🖥️ Running the ProjectStart the Vite development server for Vue:Bashnpm run dev
In a separate terminal, start the Laravel server:Bashphp artisan serve
Access the app at http://localhost:8000.🛠️ Useful CommandsCommandDescriptionphp artisan videos:clear-allWipes all videos/thumbnails from DB and Storagephp artisan videos:fix-thumbnailsGenerates missing thumbnails for existing videosphp artisan optimize:clearClears all application caches📂 Project Structureapp/Http/Controllers/VideoController.php: Handles upload logic and FFmpeg integration.resources/js/Pages/Welcome.vue: The main video grid component.storage/app/public/videos: Destination for uploaded video files.storage/app/public/thumbnails: Destination for generated JPEGs.📄 LicenseThe MIT License (MIT). Please see License File for more information.
