# Fix PHP Upload Limits - Step by Step Guide

## Current Problem
Your PHP configuration has:
- `upload_max_filesize: 2M` ⚠️ **TOO SMALL!**
- `post_max_size: 8M` ⚠️ **TOO SMALL!**

This prevents uploading images larger than 2MB or videos larger than 2MB.

## Quick Fix for Windows (XAMPP/WAMP/Laravel)

### Step 1: Find Your php.ini File

Run this command in your terminal:
```bash
php --ini
```

This will show you the location of your `php.ini` file. Look for:
```
Loaded Configuration File: C:\xampp\php\php.ini
```
or
```
Loaded Configuration File: C:\wamp\bin\php\php8.x\php.ini
```

### Step 2: Edit php.ini

1. **Open the file location** shown above in File Explorer
2. **Right-click on `php.ini`** → **Open with** → **Notepad** (or any text editor)
3. **Run Notepad as Administrator** (important!)
   - Right-click Notepad → Run as Administrator
   - Then open php.ini from within Notepad

### Step 3: Find and Update These Settings

Press `Ctrl+F` to search for each setting and update them:

```ini
; Find this line (around line 800-900)
upload_max_filesize = 2M
; Change it to:
upload_max_filesize = 10M

; Find this line (around line 800-900)
post_max_size = 8M
; Change it to:
post_max_size = 12M

; Find this line (around line 400-500)
max_execution_time = 30
; Change it to:
max_execution_time = 300

; Find this line (around line 400-500)
max_input_time = 60
; Change it to:
max_input_time = 300

; Find this line (around line 400-500)
memory_limit = 128M
; Change it to (if not already higher):
memory_limit = 256M
```

### Step 4: Save and Restart

1. **Save the file** (`Ctrl+S`)
2. **Restart your web server:**
   - **XAMPP**: Open XAMPP Control Panel → Stop Apache → Start Apache
   - **WAMP**: Click WAMP icon → Restart All Services
   - **Laravel `php artisan serve`**: Stop it (`Ctrl+C`) and restart with `php artisan serve`

### Step 5: Verify the Changes

1. Go back to: `http://localhost:8000/admin/who-we-are`
2. Check the yellow info box - it should now show:
   - `upload_max_filesize: 10M` ✅
   - `post_max_size: 12M` ✅

3. Try uploading your image again!

## Alternative: Using .htaccess (Apache Only)

If you're using Apache (not `php artisan serve`), you can also add these to `public/.htaccess`:

```apache
php_value upload_max_filesize 10M
php_value post_max_size 12M
php_value max_execution_time 300
php_value max_input_time 300
```

**Note:** This only works with Apache, not with `php artisan serve`.

## For Laravel Sail (Docker)

If you're using Laravel Sail, add to `docker-compose.yml`:

```yaml
services:
  laravel.test:
    environment:
      PHP_UPLOAD_MAX_FILESIZE: 10M
      PHP_POST_MAX_SIZE: 12M
```

Then rebuild:
```bash
./vendor/bin/sail down
./vendor/bin/sail up -d
```

## Troubleshooting

### Still Not Working?

1. **Make sure you restarted the server** - Changes won't take effect until restart
2. **Check if you edited the correct php.ini** - Run `php --ini` again to verify
3. **Check file permissions** - Make sure php.ini is writable
4. **Try a smaller file first** - Upload a 1MB file to test if the fix worked

### Can't Find php.ini?

Run this command to see all PHP configuration:
```bash
php -i | findstr "Configuration File"
```

Or create a test file `test.php`:
```php
<?php phpinfo(); ?>
```

Visit it in your browser and look for "Loaded Configuration File".

## Recommended Settings

For this application:
- **Images**: Up to 5MB → Need `upload_max_filesize = 5M` minimum
- **Videos**: Up to 10MB → Need `upload_max_filesize = 10M` minimum

**Recommended values:**
```ini
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 300
max_input_time = 300
memory_limit = 256M
```

## Need More Help?

Check the error message in the admin panel - it will show your current PHP limits and suggest what to change.
