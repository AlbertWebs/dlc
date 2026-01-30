<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Creates a strong admin user based on the domain dlc.co.ke
     * 
     * Credentials:
     * Email: admin@dlc.co.ke
     * Password: DLC@2026!AdminSecure
     */
    public function run(): void
    {
        // Check if admin user already exists
        $admin = User::where('email', 'admin@dlc.co.ke')->first();
        
        if ($admin) {
            $this->command->info('Admin user already exists. Updating password...');
            $admin->update([
                'password' => Hash::make('DLC@2026!AdminSecure'),
                'name' => 'DLC Administrator',
            ]);
            $this->command->info('✓ Admin user password updated successfully!');
        } else {
            User::create([
                'name' => 'DLC Administrator',
                'email' => 'admin@dlc.co.ke',
                'email_verified_at' => now(),
                'password' => Hash::make('DLC@2026!AdminSecure'),
            ]);
            $this->command->info('✓ Admin user created successfully!');
        }
        
        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('  ADMIN CREDENTIALS');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();
        $this->command->line('  Email:    <fg=cyan>admin@dlc.co.ke</>');
        $this->command->line('  Password: <fg=cyan>DLC@2026!AdminSecure</>');
        $this->command->newLine();
        $this->command->warn('  ⚠️  Please save these credentials securely!');
        $this->command->warn('  ⚠️  Change the password after first login for security.');
        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
    }
}
