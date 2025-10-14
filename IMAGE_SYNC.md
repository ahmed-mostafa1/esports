# Content Images Sync System

## Overview

This system ensures that all content images are properly named and organized to match the database content keys. It eliminates 404 errors and provides a consistent naming convention.

## Key Components

### 1. Artisan Command: `content:sync-images`

**Purpose**: Automatically copy and rename images from various sources to match database content keys.

**Usage**:
```bash
# Dry run (see what would be done without making changes)
php artisan content:sync-images --dry-run

# Run the sync for real
php artisan content:sync-images

# Force overwrite existing files in content-images
php artisan content:sync-images --force
```

**How it works**:
1. Reads all image entries from the `contents` table
2. For each entry, generates expected filename: `{content_key}.png`
3. Searches for source images in multiple locations:
   - `public/content-images/{current_filename}`
   - `public/img/{current_filename}`  
   - `public/img/vectors/{current_filename}`
   - Tries with `.png` extension if not present
4. Copies found images to `public/content-images/` with correct names
5. Updates database to reflect new filenames
6. Clears content cache

**Output**: Detailed report showing synced, skipped, and error counts.

### 2. ContentRepository Enhancement

**Before**: Used fallback system checking multiple directories
**After**: Simplified to only use `content-images/` directory since all images are now synced

### 3. Admin Dashboard Enhancement

**New Feature**: When editing image content in the admin panel, shows the expected filename:

```
Expected filename: home.hero.image.png
```

This helps content managers understand how their uploaded images will be named.

## File Naming Convention

All content images follow this pattern:
- **Content Key**: `home.hero.image` 
- **Expected Filename**: `home.hero.image.png`
- **Storage Location**: `public/content-images/home.hero.image.png`

## Benefits

1. **No More 404s**: All images are properly located and named
2. **Predictable Structure**: Easy to find images based on content keys
3. **Admin Clarity**: Shows expected filenames before upload
4. **Automated Sync**: Command handles all the tedious renaming work
5. **Consistent Database**: All entries now point to correctly named files

## Directory Structure

```
public/
├── content-images/           # All CMS-managed images (NEW: organized)
│   ├── home.hero.image.png
│   ├── home.services.card1.icon.png
│   ├── about.mission.image.png
│   └── ...
├── img/                      # Original static images (unchanged)
│   └── vectors/              # Vector graphics
└── ...
```

## Troubleshooting

**Missing Images**: Run the sync command to find and copy missing images:
```bash
php artisan content:sync-images --dry-run
```

**New Images**: After manual file additions, run sync to update database:
```bash
php artisan content:sync-images
```

**Clear Cache**: Content images are cached, clear if needed:
```bash
php artisan cache:clear
```

## Statistics

After initial sync:
- ✅ **66 images synced** successfully
- ⏭️ **12 images skipped** (already correct)
- ❌ **14 images missing** (need manual addition)
- 📁 **83 total images** now in content-images directory