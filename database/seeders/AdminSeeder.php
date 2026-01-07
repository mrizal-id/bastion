<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Role via Spatie
        $role = Role::create(['name' => 'superadmin']);

        // 2. Buat User Admin Pertama (Project Bastion Owner)
        $admin = User::create([
            'name' => 'Super Admin Bastion',
            'email' => 'admin@bastion.id',
            'password' => Hash::make('password123'), // Ganti saat produksi!
            'status' => 'active',
            'security_level' => 5, // Level tertinggi
        ]);

        // 3. Pasangkan Role ke Admin
        $admin->assignRole($role);

        $this->command->info('Admin Bastion berhasil dibuat!');
        $this->command->info('Email: admin@bastion.id | Pass: password123');
    }
}
