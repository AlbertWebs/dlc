# Quick Fix for Upload Error

## Problem Found
Your `php.ini` file at `C:\php-8.4.13\php.ini` has:
- ✅ `upload_max_filesize = 200M` (Good!)
- ❌ `post_max_size = 8M` (TOO SMALL!)
- ✅ `max_execution_time = 300` (Good!)
- ⚠️ `max_input_time = 60` (Could be higher)

## The Issue
`post_max_size` must be **larger** than `upload_max_filesize` because it includes the file PLUS all form data. Currently it's only 8M, which is too small.

## Quick Fix (2 minutes)

### Step 1: Open php.ini
1. Open File Explorer
2. Navigate to: `C:\php-8.4.13\`
3. Right-click `php.ini` → **Open with** → **Notepad**
4. **Run Notepad as Administrator** (Right-click Notepad → Run as Administrator)

### Step 2: Find and Change
Press `Ctrl+F` and search for:
```
post_max_size
```

Change this line:
```ini
post_max_size = 8M
```

To:
```ini
post_max_size = 12M
```

(Optional: Also change `max_input_time = 60` to `max_input_time = 300`)

### Step 3: Save and Restart
1. Save the file (`Ctrl+S`)
2. **Stop your Laravel server** (press `Ctrl+C` in the terminal where `php artisan serve` is running)
3. **Restart it**: `php artisan serve`
4. Refresh the admin page and try uploading again!

## Verify It Worked
After restarting, go to `http://localhost:8000/admin/who-we-are` and check the yellow info box. It should now show:
- `post_max_size: 12M` ✅

## Why This Happens
When you upload a file, PHP needs to handle:
- The file itself (up to `upload_max_filesize`)
- All form data (text fields, etc.)
- HTTP headers

All of this together must fit within `post_max_size`. That's why `post_max_size` needs to be larger than `upload_max_filesize`.
