<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ExportDatabaseSeeders extends Command
{
    protected $signature = 'db:export-seeders {--tables= : Comma-separated list of tables to export}';
    protected $description = 'Export all database data to seeders';

    protected $tables = [
        'users',
        'pages',
        'navigations',
        'programs',
        'team_members',
        'events',
        'hero_banners',
        'settings',
        'coaches',
        'videos',
        'testimonials',
        'blog_posts',
        'legal_pages',
    ];

    public function handle()
    {
        $this->info('Starting database export to seeders...');

        $tablesToExport = $this->option('tables')
            ? explode(',', $this->option('tables'))
            : $this->tables;

        foreach ($tablesToExport as $table) {
            if (!Schema::hasTable($table)) {
                $this->warn("Table {$table} does not exist, skipping...");
                continue;
            }

            $this->info("Exporting {$table}...");
            $this->exportTable($table);
        }

        $this->info('Database export completed!');
        $this->info('Seeders created in database/seeders/ directory.');
    }

    protected function exportTable($tableName)
    {
        $records = DB::table($tableName)->get();
        
        if ($records->isEmpty()) {
            $this->warn("  No records found in {$tableName}");
            return;
        }

        $this->info("  Found {$records->count()} records");

        $seederName = Str::studly(Str::singular($tableName)) . 'Seeder';
        $seederPath = database_path("seeders/{$seederName}.php");

        $content = $this->generateSeederContent($tableName, $records, $seederName);
        
        file_put_contents($seederPath, $content);
        $this->info("  Created {$seederName}.php");
    }

    protected function generateSeederContent($tableName, $records, $seederName)
    {
        $modelName = Str::studly(Str::singular($tableName));
        $modelClass = "App\\Models\\{$modelName}";
        
        // Check if model exists
        $useModel = class_exists($modelClass);
        
        $content = "<?php\n\n";
        $content .= "namespace Database\\Seeders;\n\n";
        $content .= "use Illuminate\\Database\\Seeder;\n";
        
        if ($useModel) {
            $content .= "use {$modelClass};\n";
            $className = $modelName;
        } else {
            $content .= "use Illuminate\\Support\\Facades\\DB;\n";
            $className = null;
        }
        
        $content .= "\n";
        $content .= "class {$seederName} extends Seeder\n";
        $content .= "{\n";
        $content .= "    public function run(): void\n";
        $content .= "    {\n";

        foreach ($records as $record) {
            $data = (array) $record;
            
            // Remove id from data for updateOrCreate
            $id = $data['id'];
            unset($data['id']);
            
            // Determine unique key(s) for updateOrCreate
            $uniqueKey = $this->getUniqueKey($tableName, $data);
            
            if ($useModel) {
                $content .= $this->generateModelSeederLine($className, $uniqueKey, $data, $id, $tableName);
            } else {
                $content .= $this->generateDbSeederLine($tableName, $uniqueKey, $data, $id);
            }
        }

        $content .= "    }\n";
        $content .= "}\n";

        return $content;
    }

    protected function getUniqueKey($tableName, $data)
    {
        // Determine the best unique key for each table
        $uniqueKeys = [
            'users' => ['email'],
            'pages' => ['slug'],
            'navigations' => ['label', 'url', 'location'],
            'programs' => ['slug'],
            'team_members' => ['name', 'email'],
            'events' => ['slug'],
            'hero_banners' => ['location', 'order', 'media_type', 'image', 'video_file'], // Use combination to ensure uniqueness
            'settings' => ['key'],
            'coaches' => ['slug'],
            'videos' => ['youtube_id'],
            'testimonials' => ['name', 'content'],
            'blog_posts' => ['slug'],
            'legal_pages' => ['type'],
        ];

        if (isset($uniqueKeys[$tableName])) {
            $keys = $uniqueKeys[$tableName];
            $keyData = [];
            foreach ($keys as $key) {
                if (isset($data[$key])) {
                    $keyData[$key] = $data[$key];
                } else {
                    // For nullable fields, include null in key to differentiate
                    $keyData[$key] = null;
                }
            }
            return $keyData;
        }

        // Fallback: use first non-null field
        foreach ($data as $key => $value) {
            if ($value !== null && $key !== 'created_at' && $key !== 'updated_at') {
                return [$key => $value];
            }
        }

        return [];
    }

    protected function generateModelSeederLine($className, $uniqueKey, $data, $originalId, $tableName)
    {
        $line = "        {$className}::updateOrCreate(\n";
        $line .= "            " . $this->formatArray($uniqueKey, 12) . ",\n";
        $line .= "            " . $this->formatArray($this->processData($data, $tableName), 12) . "\n";
        $line .= "        );\n\n";
        return $line;
    }

    protected function generateDbSeederLine($tableName, $uniqueKey, $data, $originalId)
    {
        // For tables without models, use DB::table
        $line = "        DB::table('{$tableName}')->updateOrInsert(\n";
        $line .= "            " . $this->formatArray($uniqueKey, 12) . ",\n";
        $line .= "            " . $this->formatArray($this->processData($data, $tableName), 12) . "\n";
        $line .= "        );\n\n";
        return $line;
    }

    protected function processData($data, $tableName)
    {
        $processed = [];
        
        // Define JSON fields for each table
        $jsonFields = [
            'programs' => ['features', 'meta'],
            'team_members' => ['credentials', 'social_links'],
            'coaches' => ['credentials', 'specializations', 'social_links'],
        ];
        
        $jsonFieldsForTable = $jsonFields[$tableName] ?? [];
        
        foreach ($data as $key => $value) {
            // Handle JSON fields
            if (in_array($key, $jsonFieldsForTable)) {
                if (is_string($value)) {
                    // Try to decode JSON string
                    $decoded = json_decode($value, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $processed[$key] = $decoded;
                    } else {
                        $processed[$key] = $value;
                    }
                } else {
                    $processed[$key] = $value;
                }
            }
            // Handle boolean fields (convert 1/0 to true/false)
            elseif (in_array($key, ['is_published', 'is_active', 'is_featured', 'is_visible', 'is_from_google'])) {
                $processed[$key] = (bool) $value;
            }
            // Handle timestamps - keep as strings (Laravel will parse them)
            elseif (in_array($key, ['created_at', 'updated_at', 'published_at', 'event_date', 'google_review_time'])) {
                $processed[$key] = $value;
            }
            else {
                $processed[$key] = $value;
            }
        }
        
        return $processed;
    }

    protected function formatArray($array, $indent = 0)
    {
        $spaces = str_repeat(' ', $indent);
        $lines = [];
        $lines[] = '[';
        
        foreach ($array as $key => $value) {
            $formattedValue = $this->formatValue($value);
            $lines[] = $spaces . "    '{$key}' => {$formattedValue},";
        }
        
        $lines[] = $spaces . ']';
        return implode("\n", $lines);
    }

    protected function formatValue($value)
    {
        if ($value === null) {
            return 'null';
        }
        
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        
        if (is_int($value) || is_float($value)) {
            return $value;
        }
        
        if (is_array($value) || is_object($value)) {
            $json = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            // Indent JSON for better readability
            $lines = explode("\n", $json);
            $indented = array_map(function($line) {
                return '                ' . $line;
            }, $lines);
            return implode("\n", $indented);
        }
        
        // String - escape properly, handle already quoted strings
        if (is_string($value) && (strpos($value, "'") === 0 || strpos($value, '"') === 0)) {
            return $value; // Already quoted (like timestamps)
        }
        
        $escaped = addslashes($value);
        return "'{$escaped}'";
    }
}
