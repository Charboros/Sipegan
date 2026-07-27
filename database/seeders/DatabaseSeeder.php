<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'admin',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'petugas'],
            [
                'name' => 'petugas',
                'password' => bcrypt('12345678'),
                'role' => 'petugas',
            ]
        );

        // Seeder untuk Kuota
        $currentYear = date('Y');
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        
        foreach ($months as $month) {
            \App\Models\Quota::firstOrCreate(
                ['month' => "{$currentYear}-{$month}"],
                [
                    'quota_magang' => rand(5, 20),
                    'quota_penelitian' => 0,
                ]
            );

            // Add dummy registrations for each month (1-3 registrations)
            $numRegs = rand(1, 3);
            for ($i = 0; $i < $numRegs; $i++) {
                $type = (rand(0, 1) == 0) ? 'magang' : 'penelitian';
                $statusList = ['menunggu', 'diterima', 'ditolak', 'selesai'];
                $status = $statusList[array_rand($statusList)];
                $date = "{$currentYear}-{$month}-" . sprintf('%02d', rand(1, 28));

                \App\Models\Registration::create([
                    'registration_code' => 'REG-' . strtoupper(substr(md5(uniqid()), 0, 8)),
                    'type' => $type,
                    'name' => 'Peserta ' . ucfirst($type) . ' ' . $i . ' Bulan ' . $month,
                    'email' => "peserta{$i}_{$month}@example.com",
                    'phone' => '0812' . rand(10000000, 99999999),
                    'nim_nisn' => rand(1000000000, 9999999999),
                    'institution' => 'Universitas Contoh',
                    'study_program' => 'Sistem Informasi',
                    'start_date' => $date,
                    'research_title' => $type == 'penelitian' ? 'Judul Penelitian Contoh' : null,
                    'participant_category' => 'Perguruan Tinggi',
                    'birth_place' => 'Tegal',
                    'birth_date' => '2000-01-01',
                    'gender' => (rand(0, 1) == 0) ? 'Laki-laki' : 'Perempuan',
                    'address' => 'Jl. Contoh No. 123, Tegal',
                    'magang_months' => ["{$currentYear}-{$month}"],
                    'advisor_name' => 'Bapak Pembimbing',
                    'advisor_phone' => '0813' . rand(10000000, 99999999),
                    'document_path' => null,
                    'status' => $status,
                    'created_at' => $date . ' 10:00:00',
                    'updated_at' => $date . ' 10:00:00',
                ]);
            }
        }
    }
}
