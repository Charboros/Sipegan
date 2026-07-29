<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Quota;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->seedUsers();
        $this->seedQuotas();
        $this->seedRegistrations();
        $this->seedFaqs();
    }

    private function seedUsers(): void
    {
        $users = [
            [
                'username' => 'admin',
                'name' => 'Admin Utama',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'username' => 'petugas',
                'name' => 'Petugas Pelayanan',
                'password' => bcrypt('12345678'),
                'role' => 'petugas',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['username' => $user['username']], $user);
        }
    }

    private function seedQuotas(): void
    {
        $currentYear = date('Y');
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        foreach ($months as $month) {
            Quota::updateOrCreate(
                ['month' => "{$currentYear}-{$month}"],
                [
                    'quota_magang' => 0,
                    'quota_penelitian' => 0,
                ]
            );
        }
    }

    private function seedRegistrations(): void
    {
        $currentYear = date('Y');
        $statusList = ['menunggu', 'diterima', 'selesai'];

        for ($i = 1; $i <= 3; $i++) {
            $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
            $type = ($i % 2 == 0) ? 'penelitian' : 'magang';
            $date = "{$currentYear}-{$month}-" . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);

            Registration::create([
                'type' => $type,
                'name' => 'Peserta ' . ucfirst($type) . ' ' . $i,
                'email' => "peserta{$i}@example.com",
                'phone' => '0812' . rand(10000000, 99999999),
                'nim_nisn' => rand(1000000000, 9999999999),
                'institution' => 'Universitas Teladan Bangsa',
                'study_program' => 'Sistem Informasi',
                'start_date' => $date,
                'research_title' => $type === 'penelitian' ? 'Analisis Kualitas Pelayanan Disdukcapil Tegal' : null,
                'participant_category' => 'Perguruan Tinggi',
                'birth_place' => 'Tegal',
                'birth_date' => '2001-05-15',
                'gender' => ($i % 2 == 0) ? 'Perempuan' : 'Laki-laki',
                'address' => 'Jl. Dr. Soetomo No. 12, Tegal',
                'magang_months' => ["{$currentYear}-{$month}"],
                'advisor_name' => 'Dr. Budi Santoso, M.Kom',
                'advisor_phone' => '0813' . rand(10000000, 99999999),
                'document_path' => null,
                'status' => $statusList[$i - 1],
                'created_at' => $date . ' 09:00:00',
                'updated_at' => $date . ' 09:00:00',
            ]);
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara mendaftar magang di Disdukcapil?',
                'answer' => 'Anda bisa mendaftar melalui menu "Daftar Magang" pada website ini. Siapkan dokumen surat pengantar dari kampus/sekolah Anda dalam format PDF.',
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama proses persetujuan pendaftaran?',
                'answer' => 'Proses verifikasi dan persetujuan biasanya memakan waktu maksimal 3 hari kerja setelah dokumen berhasil diunggah.',
                'is_active' => true,
            ],
            [
                'question' => 'Apakah pendaftaran magang dan penelitian dipungut biaya?',
                'answer' => 'Tidak, seluruh proses pendaftaran hingga pelaksanaan magang dan penelitian di lingkungan Disdukcapil Kabupaten Tegal 100% bebas biaya (gratis).',
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
