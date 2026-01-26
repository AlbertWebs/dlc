<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::orderBy('location')->orderBy('order')->get();
        return view('admin.hero-banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.hero-banners.create');
    }

    public function store(Request $request)
    {
        try {
            // Check if POST data was truncated (file too large for post_max_size)
            if ($request->input('video_file_attempted') && !$request->hasFile('video_file') && empty($request->all())) {
                $errorMessage = 'ERROR: File upload failed because POST data was truncated. ';
                $errorMessage .= 'The file size exceeds post_max_size (' . ini_get('post_max_size') . '). ';
                $errorMessage .= 'Please increase post_max_size in php.ini to at least 12M.';
                
                return redirect()->route('admin.hero-banners.create')
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
                
                return redirect()->route('admin.hero-banners.create')
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
                    
                    return redirect()->route('admin.hero-banners.create')
                        ->withErrors(['video_file' => $errorMessage])
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
                    
                    return redirect()->route('admin.hero-banners.create')
                        ->withErrors(['video_file' => $errorMessage])
                        ->withInput();
                }
            }

            try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|string|max:500',
            'video_url' => 'nullable|url|max:500',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:10240',
            'media_type' => 'required|in:image,video',
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'secondary_cta_text' => 'nullable|string|max:255',
            'secondary_cta_link' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
                ], [
                    'video_file.max' => 'ERROR: The video file exceeds 10MB limit. File size: ' . ($request->hasFile('video_file') ? number_format($request->file('video_file')->getSize() / 1024 / 1024, 2) . 'MB' : 'N/A') . '. Current PHP upload_max_filesize: ' . ini_get('upload_max_filesize') . '. Please reduce file size or increase PHP limits.',
                    'video_file.mimes' => 'ERROR: Invalid file type. The video file must be MP4, WebM, or OGG format. Detected type: ' . ($request->hasFile('video_file') ? $request->file('video_file')->getMimeType() : 'unknown'),
                    'video_file.uploaded' => 'ERROR: File upload failed. ' . ($request->hasFile('video_file') && !$request->file('video_file')->isValid() ? 'PHP Error Code: ' . $request->file('video_file')->getError() : 'Unknown error'),
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Return validation errors with exact messages
                return redirect()->route('admin.hero-banners.create')
                    ->withErrors($e->errors())
                    ->withInput();
            } catch (\Exception $e) {
                return redirect()->route('admin.hero-banners.create')
                    ->withErrors(['video_file' => 'ERROR: Validation failed - ' . $e->getMessage()])
                    ->withInput();
            }

        // Handle image upload
        if ($request->hasFile('image')) {
                try {
            $imagePath = $request->file('image')->store('hero-banners', 'public');
            $validated['image'] = $imagePath;
                } catch (\Exception $e) {
                    return redirect()->route('admin.hero-banners.create')
                        ->withErrors(['image' => 'ERROR uploading image: ' . $e->getMessage() . ' (Type: ' . get_class($e) . ')'])
                        ->withInput();
                }
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        } else {
            $validated['image'] = null;
        }

        // Handle video file upload
        if ($request->hasFile('video_file')) {
                try {
                    // Ensure directory exists
                    $directory = 'hero-banners/videos';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                    }
                    
                    $videoPath = $request->file('video_file')->store($directory, 'public');
                    
                    if (!$videoPath) {
                        return redirect()->route('admin.hero-banners.create')
                            ->withErrors(['video_file' => 'ERROR: Failed to store the video file. Please check storage permissions. Directory: storage/app/public/hero-banners/videos'])
                            ->withInput();
                    }
                    
            $validated['video_file'] = $videoPath;
                } catch (\Exception $e) {
                    $errorMessage = 'ERROR uploading video: ' . $e->getMessage();
                    $errorMessage .= ' (Type: ' . get_class($e) . ')';
                    
                    return redirect()->route('admin.hero-banners.create')
                        ->withErrors(['video_file' => $errorMessage])
                        ->withInput();
                }
        } else {
            $validated['video_file'] = null;
        }

        // Remove image_url from validated as it's not a database field
        unset($validated['image_url']);

        $validated['is_active'] = $request->has('is_active');

            try {
        HeroBanner::create($validated);
            } catch (\Exception $e) {
                $errorMessage = 'ERROR saving data: ' . $e->getMessage();
                $errorMessage .= ' (File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
                
                return redirect()->route('admin.hero-banners.create')
                    ->withErrors(['error' => $errorMessage])
                    ->withInput();
            }

        return redirect()->route('admin.hero-banners.index')
            ->with('success', 'Hero banner created successfully.');
        } catch (\Exception $e) {
            // Catch any unexpected errors at the top level
            $errorMessage = 'ERROR: Unexpected error occurred - ' . $e->getMessage();
            $errorMessage .= ' (Type: ' . get_class($e) . ', File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
            
            // Log the full error for debugging
            \Log::error('HeroBannerController store error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.hero-banners.create')
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }
    }

    public function edit(HeroBanner $heroBanner)
    {
        return view('admin.hero-banners.edit', compact('heroBanner'));
    }

    public function update(Request $request, HeroBanner $heroBanner)
    {
        try {
            // Check if POST data was truncated (file too large for post_max_size)
            if ($request->input('video_file_attempted') && !$request->hasFile('video_file') && empty($request->all())) {
                $errorMessage = 'ERROR: File upload failed because POST data was truncated. ';
                $errorMessage .= 'The file size exceeds post_max_size (' . ini_get('post_max_size') . '). ';
                $errorMessage .= 'Please increase post_max_size in php.ini to at least 12M.';
                
                return redirect()->route('admin.hero-banners.edit', $heroBanner)
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
                
                return redirect()->route('admin.hero-banners.edit', $heroBanner)
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
                    
                    return redirect()->route('admin.hero-banners.edit', $heroBanner)
                        ->withErrors(['video_file' => $errorMessage])
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
                    
                    return redirect()->route('admin.hero-banners.edit', $heroBanner)
                        ->withErrors(['video_file' => $errorMessage])
                        ->withInput();
                }
            }

            try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|string|max:500',
            'video_url' => 'nullable|url|max:500',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:10240',
            'media_type' => 'required|in:image,video',
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'secondary_cta_text' => 'nullable|string|max:255',
            'secondary_cta_link' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
                ], [
                    'video_file.max' => 'ERROR: The video file exceeds 10MB limit. File size: ' . ($request->hasFile('video_file') ? number_format($request->file('video_file')->getSize() / 1024 / 1024, 2) . 'MB' : 'N/A') . '. Current PHP upload_max_filesize: ' . ini_get('upload_max_filesize') . '. Please reduce file size or increase PHP limits.',
                    'video_file.mimes' => 'ERROR: Invalid file type. The video file must be MP4, WebM, or OGG format. Detected type: ' . ($request->hasFile('video_file') ? $request->file('video_file')->getMimeType() : 'unknown'),
                    'video_file.uploaded' => 'ERROR: File upload failed. ' . ($request->hasFile('video_file') && !$request->file('video_file')->isValid() ? 'PHP Error Code: ' . $request->file('video_file')->getError() : 'Unknown error'),
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Return validation errors with exact messages
                return redirect()->route('admin.hero-banners.edit', $heroBanner)
                    ->withErrors($e->errors())
                    ->withInput();
            } catch (\Exception $e) {
                return redirect()->route('admin.hero-banners.edit', $heroBanner)
                    ->withErrors(['video_file' => 'ERROR: Validation failed - ' . $e->getMessage()])
                    ->withInput();
            }

        // Handle image upload
        if ($request->hasFile('image')) {
                try {
            // Delete old image if exists
            if ($heroBanner->image && Storage::disk('public')->exists($heroBanner->image)) {
                Storage::disk('public')->delete($heroBanner->image);
            }
            $imagePath = $request->file('image')->store('hero-banners', 'public');
            $validated['image'] = $imagePath;
                } catch (\Exception $e) {
                    return redirect()->route('admin.hero-banners.edit', $heroBanner)
                        ->withErrors(['image' => 'ERROR uploading image: ' . $e->getMessage() . ' (Type: ' . get_class($e) . ')'])
                        ->withInput();
                }
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        } elseif ($request->media_type === 'video') {
            // Clear image if switching to video
            if ($heroBanner->image && Storage::disk('public')->exists($heroBanner->image)) {
                Storage::disk('public')->delete($heroBanner->image);
            }
            $validated['image'] = null;
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
                        return redirect()->route('admin.hero-banners.edit', $heroBanner)
                            ->withErrors(['video_file' => 'ERROR: Failed to store the video file. Please check storage permissions. Directory: storage/app/public/hero-banners/videos'])
                            ->withInput();
                    }
                    
            $validated['video_file'] = $videoPath;
                } catch (\Exception $e) {
                    $errorMessage = 'ERROR uploading video: ' . $e->getMessage();
                    $errorMessage .= ' (Type: ' . get_class($e) . ')';
                    
                    return redirect()->route('admin.hero-banners.edit', $heroBanner)
                        ->withErrors(['video_file' => $errorMessage])
                        ->withInput();
                }
        } elseif ($request->media_type === 'image') {
            // Clear video file if switching to image
            if ($heroBanner->video_file && Storage::disk('public')->exists($heroBanner->video_file)) {
                Storage::disk('public')->delete($heroBanner->video_file);
            }
            $validated['video_file'] = null;
        }

        // Remove image_url from validated as it's not a database field
        unset($validated['image_url']);

        $validated['is_active'] = $request->has('is_active');

            try {
        $heroBanner->update($validated);
            } catch (\Exception $e) {
                $errorMessage = 'ERROR saving data: ' . $e->getMessage();
                $errorMessage .= ' (File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
                
                return redirect()->route('admin.hero-banners.edit', $heroBanner)
                    ->withErrors(['error' => $errorMessage])
                    ->withInput();
            }

        return redirect()->route('admin.hero-banners.index')
            ->with('success', 'Hero banner updated successfully.');
        } catch (\Exception $e) {
            // Catch any unexpected errors at the top level
            $errorMessage = 'ERROR: Unexpected error occurred - ' . $e->getMessage();
            $errorMessage .= ' (Type: ' . get_class($e) . ', File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
            
            // Log the full error for debugging
            \Log::error('HeroBannerController update error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.hero-banners.edit', $heroBanner)
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }
    }

    public function destroy(HeroBanner $heroBanner)
    {
        $heroBanner->delete();

        return redirect()->route('admin.hero-banners.index')
            ->with('success', 'Hero banner deleted successfully.');
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
