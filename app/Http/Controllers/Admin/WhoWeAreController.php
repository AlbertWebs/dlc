<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhoWeAreController extends Controller
{
    public function index()
    {
        return view('admin.who-we-are.edit', [
            'settings' => $this->getSettings()
        ]);
    }

    public function update(Request $request)
    {
        try {
            // Check if POST data was truncated (file too large for post_max_size)
            // Only check if a file was actually attempted (has file size > 0)
            $videoFileAttempted = $request->input('about_video_file_attempted', '0');
            $videoFileSize = $request->input('about_video_file_size', 0);
            
            if ($videoFileAttempted == '1' && $videoFileSize > 0 && !$request->hasFile('about_video_file') && empty($request->all())) {
                $phpIniPath = php_ini_loaded_file();
                $errorMessage = 'ERROR: File upload failed because POST data was truncated. ';
                $errorMessage .= 'The file size (' . number_format($videoFileSize / 1024 / 1024, 2) . 'MB) exceeds post_max_size (' . ini_get('post_max_size') . '). ';
                $errorMessage .= 'Please increase post_max_size in php.ini to at least ' . (ceil($videoFileSize / 1024 / 1024) + 2) . 'M.';
                
                if ($phpIniPath) {
                    $errorMessage .= ' PHP ini file: ' . $phpIniPath;
                }
                
                return redirect()->route('admin.who-we-are.index')
                    ->withErrors(['about_video_file' => $errorMessage])
                    ->withInput();
            }

            // Check if file was attempted to be uploaded but failed before reaching Laravel
            // Only trigger if a file was actually selected (file size > 0)
            if ($request->has('about_video_file_attempted') && $request->input('about_video_file_attempted') == '1' && !$request->hasFile('about_video_file')) {
                $attemptedSize = $request->input('about_video_file_size', 0);
                
                // Only show error if a file was actually selected (size > 0)
                if ($attemptedSize > 0) {
                    $fileSizeMB = number_format($attemptedSize / 1024 / 1024, 2) . 'MB';
                    $phpIniPath = php_ini_loaded_file();
                    
                    $errorMessage = 'ERROR: File upload failed before reaching the server. ';
                    $errorMessage .= 'Attempted file size: ' . $fileSizeMB . '. ';
                    $errorMessage .= 'Current PHP limits - upload_max_filesize: ' . ini_get('upload_max_filesize') . ', ';
                    $errorMessage .= 'post_max_size: ' . ini_get('post_max_size') . '. ';
                    $errorMessage .= 'Your file is likely too large. Please increase these values in php.ini file.';
                    
                    if ($phpIniPath) {
                        $errorMessage .= ' PHP ini file location: ' . $phpIniPath;
                    }
                    
                    return redirect()->route('admin.who-we-are.index')
                        ->withErrors(['about_video_file' => $errorMessage])
                        ->withInput();
                }
                // If no file was selected (size = 0), don't show error - user just didn't select a file
            }

            // Check for PHP upload errors first
            if ($request->hasFile('about_video_file')) {
                $file = $request->file('about_video_file');
                
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
                    if ($request->has('about_video_file_size')) {
                        $fileSizeMB = number_format($request->input('about_video_file_size') / 1024 / 1024, 2);
                        $errorMessage .= ' Attempted file size: ' . $fileSizeMB . 'MB.';
                    }
                    
                    return redirect()->route('admin.who-we-are.index')
                        ->withErrors(['about_video_file' => $errorMessage])
                        ->withInput();
                }
                
                // Check file size manually before validation
                $fileSize = $file->getSize();
                $phpMaxSize = $this->parseSize(ini_get('upload_max_filesize'));
                
                if ($fileSize > $phpMaxSize) {
                    $fileSizeMB = number_format($fileSize / 1024 / 1024, 2);
                    $phpMaxMB = number_format($phpMaxSize / 1024 / 1024, 2);
                    $errorMessage = "File size ({$fileSizeMB}MB) exceeds PHP upload limit ({$phpMaxMB}MB). ";
                    $errorMessage .= "Please increase upload_max_filesize in php.ini from " . ini_get('upload_max_filesize') . " to at least 10M.";
                    
                    return redirect()->route('admin.who-we-are.index')
                        ->withErrors(['about_video_file' => $errorMessage])
                        ->withInput();
                }
            }

            try {
                $validated = $request->validate([
                    'about_section_title' => 'nullable|string|max:255',
                    'about_section_subtitle' => 'nullable|string|max:500',
                    'about_section_description' => 'nullable|string',
                    'about_section_image' => 'nullable|url|max:500',
                    'about_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                    'about_video_file' => 'nullable|mimes:mp4,webm,ogg|max:10240',
                    'about_section_stats_number' => 'nullable|string|max:50',
                    'about_section_stats_label' => 'nullable|string|max:255',
                    'about_section_stat1_number' => 'nullable|string|max:50',
                    'about_section_stat1_label' => 'nullable|string|max:255',
                    'about_section_stat2_number' => 'nullable|string|max:50',
                    'about_section_stat2_label' => 'nullable|string|max:255',
                    'about_section_stat3_number' => 'nullable|string|max:50',
                    'about_section_stat3_label' => 'nullable|string|max:255',
                    'about_section_stat4_number' => 'nullable|string|max:50',
                    'about_section_stat4_label' => 'nullable|string|max:255',
                    'about_section_feature_1_title' => 'nullable|string|max:255',
                    'about_section_feature_1_description' => 'nullable|string|max:500',
                    'about_section_feature_2_title' => 'nullable|string|max:255',
                    'about_section_feature_2_description' => 'nullable|string|max:500',
                    'about_section_feature_3_title' => 'nullable|string|max:255',
                    'about_section_feature_3_description' => 'nullable|string|max:500',
                    'about_section_button_text' => 'nullable|string|max:255',
                    'about_section_button_link' => 'nullable|string|max:500',
                ], [
                    'about_image_file.max' => 'ERROR: The image file exceeds 5MB limit. File size: ' . ($request->hasFile('about_image_file') ? number_format($request->file('about_image_file')->getSize() / 1024 / 1024, 2) . 'MB' : 'N/A') . '. Current PHP upload_max_filesize: ' . ini_get('upload_max_filesize') . '. Please reduce file size or increase PHP limits.',
                    'about_image_file.mimes' => 'ERROR: Invalid file type. The image file must be JPEG, PNG, GIF, or WebP format. Detected type: ' . ($request->hasFile('about_image_file') ? $request->file('about_image_file')->getMimeType() : 'unknown'),
                    'about_video_file.max' => 'ERROR: The video file exceeds 10MB limit. File size: ' . ($request->hasFile('about_video_file') ? number_format($request->file('about_video_file')->getSize() / 1024 / 1024, 2) . 'MB' : 'N/A') . '. Current PHP upload_max_filesize: ' . ini_get('upload_max_filesize') . '. Please reduce file size or increase PHP limits.',
                    'about_video_file.mimes' => 'ERROR: Invalid file type. The video file must be MP4, WebM, or OGG format. Detected type: ' . ($request->hasFile('about_video_file') ? $request->file('about_video_file')->getMimeType() : 'unknown'),
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->route('admin.who-we-are.index')
                    ->withErrors($e->errors())
                    ->withInput();
            } catch (\Exception $e) {
                return redirect()->route('admin.who-we-are.index')
                    ->withErrors(['about_video_file' => 'ERROR: Validation failed - ' . $e->getMessage()])
                    ->withInput();
            }

            // Handle image deletion
            if ($request->has('delete_about_image') && $request->input('delete_about_image') == '1') {
                $oldImage = Setting::get('about_section_image_file', '');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                Setting::set('about_section_image_file', '');
                // Also clear image URL if it was a stored file path
                $currentImageUrl = Setting::get('about_section_image', '');
                if ($currentImageUrl && str_starts_with($currentImageUrl, 'who-we-are/')) {
                    Setting::set('about_section_image', '');
                }
            }

            // Handle image file upload
            if ($request->hasFile('about_image_file')) {
                try {
                    // Delete old image file if exists
                    $oldImage = Setting::get('about_section_image_file', '');
                    if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                    
                    // Ensure directory exists
                    $directory = 'who-we-are/images';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                    }
                    
                    $imagePath = $request->file('about_image_file')->store($directory, 'public');
                    
                    if (!$imagePath) {
                        return redirect()->route('admin.who-we-are.index')
                            ->withErrors(['about_image_file' => 'ERROR: Failed to store the image file. Please check storage permissions. Directory: storage/app/public/who-we-are/images'])
                            ->withInput();
                    }
                    
                    // Store the file path in settings
                    Setting::set('about_section_image_file', $imagePath);
                    // Also set it as the image URL (will be handled in home page)
                    Setting::set('about_section_image', $imagePath);
                } catch (\Exception $e) {
                    $errorMessage = 'ERROR uploading image: ' . $e->getMessage();
                    $errorMessage .= ' (Type: ' . get_class($e) . ')';
                    
                    return redirect()->route('admin.who-we-are.index')
                        ->withErrors(['about_image_file' => $errorMessage])
                        ->withInput();
                }
            } elseif ($request->filled('about_section_image') && !str_starts_with($request->input('about_section_image'), 'who-we-are/')) {
                // If image URL is provided (not a stored file), clear the stored file
                $oldImage = Setting::get('about_section_image_file', '');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                Setting::set('about_section_image_file', '');
            }

            // Handle video deletion
            if ($request->has('delete_about_video') && $request->input('delete_about_video') == '1') {
                $oldVideo = Setting::get('about_section_video_file', '');
                if ($oldVideo && Storage::disk('public')->exists($oldVideo)) {
                    Storage::disk('public')->delete($oldVideo);
                }
                Setting::set('about_section_video_file', '');
            }

            // Handle video file upload
            if ($request->hasFile('about_video_file')) {
                try {
                    // Delete old video file if exists
                    $oldVideo = Setting::get('about_section_video_file', '');
                    if ($oldVideo && Storage::disk('public')->exists($oldVideo)) {
                        Storage::disk('public')->delete($oldVideo);
                    }
                    
                    // Ensure directory exists
                    $directory = 'who-we-are/videos';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                    }
                    
                    $videoPath = $request->file('about_video_file')->store($directory, 'public');
                    
                    if (!$videoPath) {
                        return redirect()->route('admin.who-we-are.index')
                            ->withErrors(['about_video_file' => 'ERROR: Failed to store the video file. Please check storage permissions. Directory: storage/app/public/who-we-are/videos'])
                            ->withInput();
                    }
                    
                    Setting::set('about_section_video_file', $videoPath);
                } catch (\Exception $e) {
                    $errorMessage = 'ERROR uploading video: ' . $e->getMessage();
                    $errorMessage .= ' (Type: ' . get_class($e) . ')';
                    
                    return redirect()->route('admin.who-we-are.index')
                        ->withErrors(['about_video_file' => $errorMessage])
                        ->withInput();
                }
            }

            // Save all other settings to database
            foreach ($validated as $key => $value) {
                if ($key !== 'about_video_file') {
                    Setting::set($key, $value ?? '');
                }
            }

            return redirect()->route('admin.who-we-are.index')
                ->with('success', 'Who We Are section updated successfully!');
        } catch (\Exception $e) {
            $errorMessage = 'ERROR: Unexpected error occurred - ' . $e->getMessage();
            $errorMessage .= ' (Type: ' . get_class($e) . ', File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
            
            \Log::error('WhoWeAreController update error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.who-we-are.index')
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

    private function getSettings()
    {
        return [
            'about_section_title' => Setting::get('about_section_title', 'Empowering Lives Through Expert Coaching'),
            'about_section_subtitle' => Setting::get('about_section_subtitle', 'We are a leading coaching organization dedicated to helping individuals unlock their full potential through personalized guidance, proven methodologies, and comprehensive certification programs.'),
            'about_section_description' => Setting::get('about_section_description', 'Our mission is to transform lives by providing world-class coaching education and support. With years of experience and a commitment to excellence, we\'ve helped thousands of individuals achieve their personal and professional goals.'),
            'about_section_image' => Setting::get('about_section_image', ''),
            'about_section_stats_number' => Setting::get('about_section_stats_number', '4,000+'),
            'about_section_stats_label' => Setting::get('about_section_stats_label', 'CLIENTS'),
            'about_section_stat1_number' => Setting::get('about_section_stat1_number', '500+'),
            'about_section_stat1_label' => Setting::get('about_section_stat1_label', 'COACHES TRAINED'),
            'about_section_stat2_number' => Setting::get('about_section_stat2_number', '10+'),
            'about_section_stat2_label' => Setting::get('about_section_stat2_label', 'BOOKS WRITTEN'),
            'about_section_stat3_number' => Setting::get('about_section_stat3_number', '18+'),
            'about_section_stat3_label' => Setting::get('about_section_stat3_label', 'YEARS Experience'),
            'about_section_stat4_number' => Setting::get('about_section_stat4_number', '4,000+'),
            'about_section_stat4_label' => Setting::get('about_section_stat4_label', 'CLIENTS'),
            'about_section_feature_1_title' => Setting::get('about_section_feature_1_title', 'Internationally Certified Programs'),
            'about_section_feature_1_description' => Setting::get('about_section_feature_1_description', 'Globally recognized certifications that open doors to new opportunities'),
            'about_section_feature_2_title' => Setting::get('about_section_feature_2_title', 'Expert Coaching Team'),
            'about_section_feature_2_description' => Setting::get('about_section_feature_2_description', 'Learn from experienced professionals with proven track records'),
            'about_section_feature_3_title' => Setting::get('about_section_feature_3_title', 'Proven Results & Success Stories'),
            'about_section_feature_3_description' => Setting::get('about_section_feature_3_description', 'Join thousands who have transformed their lives through our programs'),
            'about_section_video_file' => Setting::get('about_section_video_file', ''),
            'about_section_image_file' => Setting::get('about_section_image_file', ''),
            'about_section_button_text' => Setting::get('about_section_button_text', 'Learn More About Us'),
            'about_section_button_link' => Setting::get('about_section_button_link', route('about')),
        ];
    }
}
