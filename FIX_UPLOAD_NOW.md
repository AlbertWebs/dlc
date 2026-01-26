# URGENT: Fix Upload Error - Step by Step

## Current Problem
Your PHP configuration shows:
- ✅ `upload_max_filesize: 200M` (Good!)
- ❌ `post_max_size: 8M` (TOO SMALL!)

**The error occurs because `post_max_size` (8M) is smaller than `upload_max_filesize` (200M).**

## Quick Fix (3 Steps - 2 Minutes)

### Step 1: Open php.ini File
1. Press `Windows Key + R`
2. Type: `notepad C:\php-8.4.13\php.ini`
3. Press `Enter`
4. **If it asks for permission, click "Yes" or "Run as Administrator"**

### Step 2: Find and Change post_max_size
1. Press `Ctrl+F` to open Find dialog
2. Type: `post_max_size`
3. Press `Enter`
4. You should see a line like: `post_max_size = 8M`
5. Change it to: `post_max_size = 220M`
   - (This should be larger than upload_max_filesize to accommodate file + form data)

### Step 3: Save and Restart
1. Press `Ctrl+S` to save
2. **IMPORTANT:** Go to your terminal where `php artisan serve` is running
3. Press `Ctrl+C` to stop the server
4. Type: `php artisan serve`
5. Press `Enter` to restart
6. Go back to `http://localhost:8000/admin/who-we-are` and try uploading again!

## Verify It Worked
After restarting, the yellow info box on the admin page should show:
- `post_max_size: 220M` ✅

## Alternative: If You Can't Edit php.ini
If you can't edit the file, try this command in PowerShell (as Administrator):
```powershell
(Get-Content C:\php-8.4.13\php.ini) -replace 'post_max_size = 8M', 'post_max_size = 220M' | Set-Content C:\php-8.4.13\php.ini
```
Then restart your Laravel server.

## Still Not Working?
1. Make sure you **restarted** the Laravel server after changing php.ini
2. Check that the file was saved correctly
3. Try closing and reopening your browser
4. Clear browser cache (Ctrl+Shift+Delete)
