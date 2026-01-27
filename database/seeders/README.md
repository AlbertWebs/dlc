# Database Seeders Documentation

This directory contains comprehensive database seeders that capture the complete current state of the production website.

## Overview

All seeders are **idempotent** - they use `updateOrCreate()` methods, making them safe to run multiple times. They will update existing records or create new ones as needed.

## Seeder Files

### Active Seeders (with production data)

1. **SettingSeeder.php** - All 66 site settings (site name, email, social media links, etc.)
2. **NavigationSeeder.php** - All 17 navigation items (header and footer menus)
3. **ProgramSeeder.php** - All 3 coaching programs
4. **HeroBannerSeeder.php** - All 2 hero banners (home page)
5. **VideoSeeder.php** - All 4 YouTube videos
6. **CoachSeeder.php** - All 3 coaches
7. **ImportedCoaches20260127Seeder.php** - Additional imported coaches
8. **BlogPostSeeder.php** - All 19 blog posts
9. **LegalPageSeeder.php** - Privacy Policy and Terms of Service pages

### Empty Seeders (ready for future data)

- **UserSeeder.php** - Users (no data in production)
- **PageSeeder.php** - Custom pages (no data in production)
- **TeamMemberSeeder.php** - Team members (no data in production)
- **EventSeeder.php** - Events (no data in production)
- **TestimonialSeeder.php** - Testimonials (no data in production)

## Usage

### Seed All Data

```bash
php artisan db:seed
```

Or specifically:

```bash
php artisan db:seed --class=DatabaseSeeder
```

### Seed Individual Tables

```bash
php artisan db:seed --class=SettingSeeder
php artisan db:seed --class=NavigationSeeder
php artisan db:seed --class=ProgramSeeder
# etc.
```

### Fresh Migration with Seeding

To completely reset the database and restore from seeders:

```bash
php artisan migrate:fresh --seed
```

**⚠️ WARNING:** This will delete all existing data and recreate the database structure, then seed all data.

## Data Preservation

All seeders preserve:
- ✅ Original `created_at` timestamps
- ✅ Original `updated_at` timestamps
- ✅ All relationships and foreign keys
- ✅ JSON field structures (credentials, social_links, features, etc.)
- ✅ Boolean values (is_published, is_active, etc.)
- ✅ Draft and inactive records (nothing is omitted)

## Exporting New Data

If you need to update seeders with new production data, use the export command:

```bash
php artisan db:export-seeders
```

This will regenerate all seeders with current database data. You can also export specific tables:

```bash
php artisan db:export-seeders --tables=settings,programs
```

## Seeder Structure

Each seeder follows this pattern:

```php
Model::updateOrCreate(
    ['unique_key' => 'value'], // Unique identifier
    [
        // All fields with original values
        'field1' => 'value1',
        'field2' => 'value2',
        'created_at' => '2026-01-26 08:10:18',
        'updated_at' => '2026-01-26 16:33:40',
    ]
);
```

## Unique Keys Used

Each table uses specific unique keys for `updateOrCreate`:

- **settings**: `key`
- **navigations**: `label`, `url`, `location`
- **programs**: `slug`
- **hero_banners**: `location`, `order`, `media_type`, `image`, `video_file`
- **videos**: `youtube_id`
- **coaches**: `slug`
- **blog_posts**: `slug`
- **legal_pages**: `type`

## Important Notes

1. **Media Files**: Seeded file paths reference files in `storage/app/public/`. Ensure these files exist or are uploaded separately.

2. **Localhost URLs**: Some seeded data contains `localhost:8000` URLs. Update these in production or use environment variables.

3. **Dependencies**: Seeders are called in a specific order in `DatabaseSeeder` to respect dependencies (settings first, then navigation, then content).

4. **Idempotency**: All seeders are safe to run multiple times. They will update existing records rather than creating duplicates.

5. **Empty Tables**: Tables with no production data have empty seeders with example structures commented out for reference.

## Testing Seeders

To verify seeders work correctly:

```bash
# Reset and seed
php artisan migrate:fresh --seed

# Verify data
php artisan tinker
>>> App\Models\Setting::count()
>>> App\Models\Program::count()
>>> App\Models\BlogPost::count()
# etc.
```

## Maintenance

When production data changes:

1. Run the export command: `php artisan db:export-seeders`
2. Review generated seeders for accuracy
3. Test with: `php artisan migrate:fresh --seed`
4. Commit updated seeders to version control

## Production Deployment

For production deployment:

1. Run migrations: `php artisan migrate`
2. Run seeders: `php artisan db:seed`
3. Verify all data is present
4. Check that media files are in place

The seeders will update existing records or create new ones, so they're safe to run on production databases with existing data.
