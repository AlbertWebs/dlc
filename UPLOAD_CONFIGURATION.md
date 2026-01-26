# Upload Configuration Guide

## Video Upload Size Limit: 10MB

The application has been configured to accept video file uploads up to 10MB.

## Configuration Changes Made

### 1. Laravel Validation Rules
- Updated `FullWidthVideoController` and `HeroBannerController` to accept files up to 10MB (10240 KB)

### 2. Apache Configuration (.htaccess)
- Added PHP upload limits in `public/.htaccess`:
  - `upload_max_filesize = 10M`
  - `post_max_size = 12M` (slightly larger to accommodate form data)
  - `max_execution_time = 300` (5 minutes for large uploads)
  - `max_input_time = 300`

## Additional Server Configuration

### For Apache Servers
The `.htaccess` file should automatically apply these settings. If you're using Apache with `mod_php`, the settings will take effect immediately.

### For Nginx Servers
If you're using Nginx, you need to add these settings to your PHP-FPM configuration:

Edit your `php.ini` file (usually located at `/etc/php/8.x/fpm/php.ini` or similar):

```ini
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 300
max_input_time = 300
```

Then restart PHP-FPM:
```bash
sudo systemctl restart php8.x-fpm
```

### For Windows Development (XAMPP/WAMP)
1. Locate your `php.ini` file (usually in `C:\xampp\php\php.ini` or `C:\wamp\bin\php\php8.x\php.ini`)
2. Find and update these values:
   ```ini
   upload_max_filesize = 10M
   post_max_size = 12M
   max_execution_time = 300
   max_input_time = 300
   ```
3. Restart Apache/PHP service

### For Laravel Valet
Edit `~/.config/valet/valet.conf` or create a custom PHP configuration.

### For Docker/Laravel Sail
Add these to your `docker-compose.yml` or create a custom `php.ini`:

```yaml
environment:
  PHP_UPLOAD_MAX_FILESIZE: 10M
  PHP_POST_MAX_SIZE: 12M
```

## Verifying Configuration

You can verify your PHP upload limits by creating a simple PHP info page or running:

```bash
php -i | grep upload_max_filesize
php -i | grep post_max_size
```

Or visit: `http://your-domain.com/admin/full-width-video` and check the upload form.

## Troubleshooting

If uploads still fail after configuration:

1. **Check PHP Error Logs**: Look for upload-related errors
2. **Verify File Permissions**: Ensure `storage/app/public/hero-banners/videos` is writable
3. **Check Disk Space**: Ensure sufficient disk space is available
4. **Network Timeout**: For very large files, you may need to increase timeout settings
5. **Web Server Limits**: Some hosting providers have additional limits beyond PHP settings

## Current Limits

- **Video Files**: 10MB (MP4, WebM, OGG)
- **Image Files**: 5MB (JPEG, PNG, JPG, GIF, WebP)
