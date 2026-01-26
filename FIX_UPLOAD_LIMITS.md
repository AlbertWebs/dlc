# Fix Video Upload Limits - URGENT

## Current Problem
Your PHP configuration currently has:
- `upload_max_filesize: 2M` (too small!)
- `post_max_size: 8M`

This is preventing video uploads larger than 2MB.

## Quick Fix Options

### Option 1: Windows (XAMPP/WAMP) - RECOMMENDED

1. **Locate your php.ini file:**
   - XAMPP: `C:\xampp\php\php.ini`
   - WAMP: `C:\wamp\bin\php\php8.x\php.ini`
   - Laravel Sail/Docker: Check your docker-compose.yml

2. **Open php.ini in a text editor** (as Administrator)

3. **Find and update these lines:**
   ```ini
   upload_max_filesize = 10M
   post_max_size = 12M
   max_execution_time = 300
   max_input_time = 300
   memory_limit = 256M
   ```

4. **Save the file**

5. **Restart your web server:**
   - XAMPP: Stop and Start Apache from Control Panel
   - WAMP: Restart All Services
   - Laravel: `php artisan serve` (restart the command)

6. **Verify the changes:**
   ```bash
   php -r "echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . PHP_EOL;"
   ```
   Should show: `upload_max_filesize: 10M`

### Option 2: Shared Hosting (cPanel)

1. **Create or edit `.user.ini` file** in your `public` folder
   - I've already created this file for you at `public/.user.ini`
   - The server should automatically read it

2. **Wait 5-10 minutes** for changes to take effect

3. **Check via PHP Info** or the diagnostic section in the admin panel

### Option 3: Laravel Sail (Docker)

Add to your `docker-compose.yml`:

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

### Option 4: Nginx + PHP-FPM

Edit your PHP-FPM configuration (usually `/etc/php/8.x/fpm/php.ini`):

```ini
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 300
max_input_time = 300
```

Then restart:
```bash
sudo systemctl restart php8.x-fpm
sudo systemctl restart nginx
```

## Verify After Changes

1. Go to: `http://your-domain.com/admin/full-width-video`
2. Check the yellow info box - it should show:
   - upload_max_filesize: 10M
   - post_max_size: 12M

3. Try uploading a video file (under 10MB)

## Still Not Working?

1. **Check file permissions:**
   ```bash
   # Ensure storage directory is writable
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

2. **Check Laravel logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. **Check PHP error logs:**
   - Location varies by setup
   - XAMPP: `C:\xampp\php\logs\php_error_log`
   - WAMP: Check WAMP control panel

4. **Test with a small file first** (1-2MB) to verify the fix worked

## Files Created

I've created these files to help:
- `public/.htaccess` - Updated with upload limits
- `public/.user.ini` - For shared hosting
- `public/php.ini` - Reference file (copy settings to your main php.ini)

## Need Help?

The error message in the admin panel will now show the specific PHP error code and message, which will help diagnose the exact issue.
