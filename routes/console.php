<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



Artisan::command('videos:clear-all', function () {
    if ($this->confirm('This will delete ALL videos and thumbnails from the database and storage. Continue?')) {

        // 1. Clear Database
        Video::truncate();
        $this->info("Database table 'videos' cleared.");

        // 2. Clear Storage Folders
        // We delete everything inside the 'videos' and 'thumbnails' folders
        Storage::disk('public')->deleteDirectory('videos');
        Storage::disk('public')->deleteDirectory('thumbnails');

        // 3. Re-create empty folders
        Storage::disk('public')->makeDirectory('videos');
        Storage::disk('public')->makeDirectory('thumbnails');

        $this->info("Storage folders 'videos' and 'thumbnails' cleared and recreated.");
    }
});
