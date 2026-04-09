<?php

namespace App\Exports;

use App\Models\Jemaat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JemaatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Jemaat::select(
            'nama_lengkap',
            'nama_panggilan',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'status_perkawinan',
            'alamat',
            'no_telp',
            'email',
            'pekerjaan',
            'status_jemaat',
            'tanggal_bergabung'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Nama Panggilan',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status Perkawinan',
            'Alamat',
            'No. Telepon',
            'Email',
            'Pekerjaan',
            'Status Jemaat',
            'Tanggal Bergabung'
        ];
    }
}