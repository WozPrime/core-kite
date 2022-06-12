<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meeting::create([
            'project_id' => '2',
            'client_id' => '2',
            'tanggal_pertemuan' => '2022-06-20 13:00:00',
            'tempat_pertemuan' => 'Online(Google Meet)',
            'deskripsi_pertemuan' => 'Membahas perbaikan bug',
            'sistem_analis' => '',
            'catatan_admin' => 'Dapat dilakukan',
            'hasil_pertemuan' => 'Penambahan fitur search dokumen',
            'dokumen_pertemuan' => '',
            'status_pertemuan' => 'SELESAI',
        ]);
        Meeting::create([
            'project_id' => '2',
            'client_id' => '2',
            'tanggal_pertemuan' => '2022-06-16 13:00:00',
            'tempat_pertemuan' => 'Online(Google Meet)',
            'deskripsi_pertemuan' => 'Membahas penambahan fitur',
            'sistem_analis' => '',
            'catatan_admin' => 'Dapat dilakukan',
            'hasil_pertemuan' => '',
            'dokumen_pertemuan' => '',
            'status_pertemuan' => 'DISETUJUI',
        ]);
    }
}
