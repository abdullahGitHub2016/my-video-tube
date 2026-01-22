<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;

class VideoController extends Controller
{
    /**
     * Display the homepage grid
     */
    public function index()
    {
        $videos = \App\Models\Video::with('user')->latest()->get();

        return Inertia::render('Welcome', [
            'videos' => $videos,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    public function show(Video $video)
    {
        // Load the user who uploaded it and maybe some related videos
        $video->load('user');

        return inertia('videos/Show', [
            'video' => $video,
            'relatedVideos' => Video::with('user')->where('id', '!=', $video->id)->limit(8)->get()
        ]);
    }
    /**
     * Show the "Upload" page
     */

    /**
     * Show the form for creating a new video.
     */
    public function create(): Response
    {
        // This looks for: resources/js/Pages/Videos/Create.vue
        return Inertia::render('videos/Create');
    }
    /**
     * Store a newly created video and generate a thumbnail.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime|max:102400',
        ]);

        // 1. Store Video
        $videoPath = $request->file('video')->store('videos', 'public');

        // 2. Setup Thumbnail Paths
        $thumbnailName = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';

        // Ensure directory exists
        if (!Storage::disk('public')->exists('thumbnails')) {
            Storage::disk('public')->makeDirectory('thumbnails');
        }

        try {
            // 3. Initialize FFmpeg
            $ffmpeg = FFMpeg::create([
        // Use forward slashes for the paths to avoid Windows escaping issues
        'ffmpeg.binaries'  => 'C:/Users/MY_PC/AppData/Local/Microsoft/WinGet/Packages/Gyan.FFmpeg_Microsoft.Winget.Source_8wekyb3d8bbwe/ffmpeg-8.0.1-full_build/bin/ffmpeg.exe',
        'ffprobe.binaries' => 'C:/Users/MY_PC/AppData/Local/Microsoft/WinGet/Packages/Gyan.FFmpeg_Microsoft.Winget.Source_8wekyb3d8bbwe/ffmpeg-8.0.1-full_build/bin/ffprobe.exe',
        'timeout'          => 3600,
        'ffmpeg.threads'   => 12,
    ]);

            // Use absolute paths for Windows stability
            $fullVideoPath = storage_path('app/public/' . $videoPath);
            $fullThumbnailPath = storage_path('app/public/' . $thumbnailName);

            $video = $ffmpeg->open($fullVideoPath);

            // 4. Capture frame at 1 second
            $video->frame(TimeCode::fromSeconds(1))
                ->save($fullThumbnailPath);

            $thumbnailStatus = Storage::disk('public')->exists($thumbnailName) ? "success" : "failed";

        } catch (\Exception $e) {
            Log::error("FFmpeg Error: " . $e->getMessage());
            $thumbnailStatus = "error";
            // Fallback: If FFmpeg fails, you can set a default thumbnail image here
            // $thumbnailName = 'thumbnails/default.jpg';
        }

        // 5. Create Database Record
        Video::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailName,
        ]);

        return redirect()->route('home')->with([
            'success' => 'Video published successfully!',
            'thumbnail_status' => $thumbnailStatus
        ]);
    }
}
