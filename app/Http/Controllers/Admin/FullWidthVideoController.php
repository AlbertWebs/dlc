<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FullWidthVideoController extends Controller
{
    public function index()
    {
        // Get or create the full width video hero banner
        $heroBanner = HeroBanner::where('location', 'home')
            ->where('media_type', 'video')
            ->first();

        // If it doesn't exist, create a default one
        if (!$heroBanner) {
            $heroBanner = HeroBanner::create([
                'title' => 'Transform Your Life Through Professional Coaching',
                'subtitle' => 'Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals.',
                'media_type' => 'video',
                'location' => 'home',
                'is_active' => true,
                'order' => 0,
            ]);
        }

        return view('admin.full-width-video.edit', compact('heroBanner'));
    }

    public function update(Request $request)
    {
        try {
            // Get or create the full width video hero banner
            $heroBanner = HeroBanner::where('location', 'home')
                ->where('media_type', 'video')
                ->first();

            if (!$heroBanner) {
                $heroBanner = new HeroBanner();
                $heroBanner->location = 'home';
                $heroBanner->media_type = 'video';
                $heroBanner->is_active = true;
                $heroBanner->order = 0;
            }

            // Check if POST data was truncated (file too large for post_max_size)
            if ($request->input('video_file_attempted') && !$request->hasFile('video_file') && empty($request->all())) {
                $errorMessage = 'ERROR: File upload failed because POST data was truncated. ';
                $errorMessage .= 'The file size exceeds post_max_size (' . ini_get('post_max_size') . '). ';
                $errorMessage .= 'Please increase post_max_size in php.ini to at least 12M.';
                
                return redirect()->route('admin.full-width-video.index')
                    ->withErrors(['video_file' => $errorMessage])
                    ->withInput();
            }

            // Check if file was attempted to be uploaded but failed before reaching Laravel
            if ($request->has('video_file_attempted') && !$request->hasFile('video_file')) {
                $attemptedSize = $request->input('video_file_size', 0);
                $fileSizeMB = $attemptedSize > 0 ? number_format($attemptedSize / 1024 / 1024, 2) . 'MB' : 'unknown size';
                
                $errorMessage = 'ERROR: File upload failed before reaching the server. ';
                $errorMessage .= 'Attempted file size: ' . $fileSizeMB . '. ';
                $errorMessage .= 'Current PHP limits - upload_max_filesize: ' . ini_get('upload_max_filesize') . ', ';
                $errorMessage .= 'post_max_size: ' . ini_get('post_max_size') . '. ';
                $errorMessage .= 'Your file is likely too large. Please increase these values in php.ini file.';
                
                return redirect()->route('admin.full-width-video.index')
                    ->withErrors(['video_file' => $errorMessage])
                    ->withInput();
            }

        // Check for PHP upload errors first
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            
            // Check if file actually exists and is valid
            if (!$file->isValid()) {
                $errorCode = $file->getError();
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini. Current limit: ' . ini_get('upload_max_filesize') . '. Your file is too large. Please increase upload_max_filesize in php.ini.',
                    UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive (10MB) specified in the HTML form.',
                    UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded. Please try again.',
                    UPLOAD_ERR_NO_FILE => 'No file was uploaded. Please select a file.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder. Contact your server administrator.',
                    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk. Check storage permissions.',
                    UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload. Check your PHP configuration.',
                ];
                
                $errorMessage = $errorMessages[$errorCode] ?? 'Unknown upload error (Error Code: ' . $errorCode . ')';
                
                // Add file size info if available
                if ($request->has('video_file_size')) {
                    $fileSizeMB = number_format($request->input('video_file_size') / 1024 / 1024, 2);
                    $errorMessage .= ' Attempted file size: ' . $fileSizeMB . 'MB.';
                }
                
                return redirect()->route('admin.full-width-video.index')
                    ->withErrors(['video_file' => $errorMessage])
                    ->withInput();
            }
            
            // Check file size manually before validation
            $fileSize = $file->getSize();
            $maxSize = 10 * 1024 * 1024; // 10MB in bytes
            $phpMaxSize = $this->parseSize(ini_get('upload_max_filesize'));
            
            if ($fileSize > $phpMaxSize) {
                $fileSizeMB = number_format($fileSize / 1024 / 1024, 2);
                $phpMaxMB = number_format($phpMaxSize / 1024 / 1024, 2);
                $errorMessage = "File size ({$fileSizeMB}MB) exceeds PHP upload limit ({$phpMaxMB}MB). ";
                $errorMessage .= "Please increase upload_max_filesize in php.ini from " . ini_get('upload_max_filesize') . " to at least 10M.";
                
                return redirect()->route('admin.full-width-video.index')
                    ->withErrors(['video_file' => $errorMessage])
                    ->withInput();
            }
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:500',
                'video_url' => 'nullable|url|max:500',
                'video_file' => 'nullable|mimes:mp4,webm,ogg|max:10240',
                'cta_text' => 'nullable|string|max:255',
                'cta_link' => 'nullable|string|max:255',
                'secondary_cta_text' => 'nullable|string|max:255',
                'secondary_cta_link' => 'nullable|string|max:255',
                'is_active' => 'boolean',
            ], [
                'video_file.max' => 'ERROR: The video file exceeds 10MB limit. File size: ' . ($request->hasFile('video_file') ? number_format($request->file('video_file')->getSize() / 1024 / 1024, 2) . 'MB' : 'N/A') . '. Current PHP upload_max_filesize: ' . ini_get('upload_max_filesize') . '. Please reduce file size or increase PHP limits.',
                'video_file.mimes' => 'ERROR: Invalid file type. The video file must be MP4, WebM, or OGG format. Detected type: ' . ($request->hasFile('video_file') ? $request->file('video_file')->getMimeType() : 'unknown'),
                'video_file.uploaded' => 'ERROR: File upload failed. ' . ($request->hasFile('video_file') && !$request->file('video_file')->isValid() ? 'PHP Error Code: ' . $request->file('video_file')->getError() : 'Unknown error'),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors with exact messages
            return redirect()->route('admin.full-width-video.index')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('admin.full-width-video.index')
                ->withErrors(['video_file' => 'ERROR: Validation failed - ' . $e->getMessage()])
                ->withInput();
        }

        // Handle video file upload
        if ($request->hasFile('video_file')) {
            try {
                // Delete old video file if exists
                if ($heroBanner->video_file && Storage::disk('public')->exists($heroBanner->video_file)) {
                    Storage::disk('public')->delete($heroBanner->video_file);
                }
                
                // Ensure directory exists
                $directory = 'hero-banners/videos';
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }
                
                $videoPath = $request->file('video_file')->store($directory, 'public');
                
                if (!$videoPath) {
                    return redirect()->route('admin.full-width-video.index')
                        ->withErrors(['video_file' => 'ERROR: Failed to store the video file. Please check storage permissions. Directory: storage/app/public/hero-banners/videos'])
                        ->withInput();
                }
                
                $validated['video_file'] = $videoPath;
                // Clear video_url if uploading a file
                $validated['video_url'] = null;
            } catch (\Exception $e) {
                $errorMessage = 'ERROR uploading video: ' . $e->getMessage();
                $errorMessage .= ' (Type: ' . get_class($e) . ')';
                
                return redirect()->route('admin.full-width-video.index')
                    ->withErrors(['video_file' => $errorMessage])
                    ->withInput();
            }
        } elseif ($request->filled('video_url')) {
            // If video URL is provided, clear video_file
            if ($heroBanner->video_file && Storage::disk('public')->exists($heroBanner->video_file)) {
                Storage::disk('public')->delete($heroBanner->video_file);
            }
            $validated['video_file'] = null;
        }

            $validated['is_active'] = $request->has('is_active');

            try {
                $heroBanner->fill($validated);
                $heroBanner->save();
            } catch (\Exception $e) {
                $errorMessage = 'ERROR saving data: ' . $e->getMessage();
                $errorMessage .= ' (File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
                
                return redirect()->route('admin.full-width-video.index')
                    ->withErrors(['error' => $errorMessage])
                    ->withInput();
            }

            return redirect()->route('admin.full-width-video.index')
                ->with('success', 'Full width video section updated successfully.');
        } catch (\Exception $e) {
            // Catch any unexpected errors at the top level
            $errorMessage = 'ERROR: Unexpected error occurred - ' . $e->getMessage();
            $errorMessage .= ' (Type: ' . get_class($e) . ', File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
            
            // Log the full error for debugging
            \Log::error('FullWidthVideoController update error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.full-width-video.index')
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }
    }

    /**
     * Parse PHP size string (e.g., "10M", "2M") to bytes
     */
    private function parseSize($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
        $size = preg_replace('/[^0-9\.]/', '', $size);
        
        if ($unit) {
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        }
        
        return round($size);
    }
}
