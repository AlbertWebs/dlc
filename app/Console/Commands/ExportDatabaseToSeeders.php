<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExportDatabaseToSeeders extends Command
{
    protected $signature = 'db:export-seeders {--table=* : Specific tables to export}';
    protected $description = 'Export current database data to seeder files';

    public function handle()
    {
        $tables = $this->option('table');
        
        if (empty($tables)) {
            // Export all main content tables (excluding users - use AdminUserSeeder)
            $tables = [
                'settings',
                'navigations',
                'programs',
                'hero_banners',
                'coaches',
                'blog_posts',
                'videos',
                'legal_pages',
                // 'users', // Skip - use AdminUserSeeder instead
                'pages',
                'team_members',
                'events',
                'testimonials',
            ];
        }

        foreach ($tables as $table) {
            $this->exportTable($table);
        }

        $this->info('✓ All seeders exported successfully!');
    }

    private function exportTable($tableName)
    {
        $this->info("Exporting {$tableName}...");
        
        $data = DB::table($tableName)->get();
        
        if ($data->isEmpty()) {
            $this->warn("  No data found in {$tableName}");
            return;
        }

        $modelName = Str::studly(Str::singular($tableName));
        $seederName = $modelName . 'Seeder';
        $seederPath = database_path("seeders/{$seederName}.php");
        
        $content = $this->generateSeederContent($tableName, $modelName, $data);
        
        file_put_contents($seederPath, $content);
        
        $this->info("  ✓ Exported {$data->count()} records to {$seederName}.php");
    }

    private function generateSeederContent($tableName, $modelName, $data)
    {
        $modelClass = "App\\Models\\{$modelName}";
        $shortModelName = $modelName;
        $namespace = "Database\\Seeders";
        
        $content = "<?php\n\n";
        $content .= "namespace {$namespace};\n\n";
        $content .= "use Illuminate\\Database\\Seeder;\n";
        $content .= "use {$modelClass};\n\n";
        $content .= "class {$modelName}Seeder extends Seeder\n";
        $content .= "{\n";
        $content .= "    public function run(): void\n";
        $content .= "    {\n";
        
        foreach ($data as $record) {
            $recordArray = (array) $record;
            
            // Determine unique key for updateOrCreate
            $uniqueKey = $this->getUniqueKey($tableName, $recordArray);
            
            $content .= "        {$shortModelName}::updateOrCreate(\n";
            $content .= "            [\n";
            foreach ($uniqueKey as $key => $value) {
                $content .= "                '{$key}' => " . $this->formatValue($value) . ",\n";
            }
            $content .= "            ],\n";
            $content .= "            [\n";
            
            // Exclude id, timestamps will be handled automatically, but we can include them for consistency
            $excludeFields = ['id'];
            if ($tableName === 'users') {
                // Don't export password hashes for users - use AdminUserSeeder instead
                $excludeFields[] = 'password';
                $excludeFields[] = 'remember_token';
            }
            
            foreach ($recordArray as $key => $value) {
                if (!in_array($key, array_keys($uniqueKey)) && !in_array($key, $excludeFields)) {
                    $content .= "                '{$key}' => " . $this->formatValue($value) . ",\n";
                }
            }
            
            $content .= "            ]\n";
            $content .= "        );\n\n";
        }
        
        $content .= "    }\n";
        $content .= "}\n";
        
        return $content;
    }

    private function getUniqueKey($tableName, $record)
    {
        // Define unique keys for each table
        $uniqueKeys = [
            'settings' => ['key'],
            'navigations' => ['label', 'url', 'location'],
            'programs' => ['slug'],
            'hero_banners' => ['location', 'order', 'media_type'], // Include media_type to differentiate video vs image
            'coaches' => ['email'],
            'blog_posts' => ['slug'],
            'videos' => ['youtube_id'],
            'legal_pages' => ['slug'],
            'users' => ['email'],
            'pages' => ['slug'],
            'team_members' => ['name', 'email'],
            'events' => ['title', 'event_date'],
            'testimonials' => ['name', 'source', 'source_id'],
        ];
        
        if (isset($uniqueKeys[$tableName])) {
            $keys = $uniqueKeys[$tableName];
            $unique = [];
            foreach ($keys as $key) {
                if (isset($record[$key])) {
                    $unique[$key] = $record[$key];
                }
            }
            return $unique;
        }
        
        // Default: use id if available
        if (isset($record['id'])) {
            return ['id' => $record['id']];
        }
        
        return [];
    }

    private function formatValue($value)
    {
        if ($value === null) {
            return 'null';
        }
        
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        
        if (is_numeric($value)) {
            return $value;
        }
        
        if (is_array($value) || is_object($value)) {
            $json = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            return $json;
        }
        
        // Escape single quotes in strings
        $escaped = str_replace("'", "\\'", $value);
        return "'{$escaped}'";
    }
}
