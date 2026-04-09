<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data Jemaat - {{ now()->format('d M Y') }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 12mm 15mm; /* Margin lebih kecil untuk tabel lebar */
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 8px; /* Font lebih kecil untuk muat banyak kolom */
            line-height: 1.2;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #2c3e50;
        }
        
        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
            color: #2c3e50;
        }
        
        .header p {
            font-size: 9px;
            color: #666;
            margin: 0;
        }
        
        .info {
            margin-bottom: 10px;
            font-size: 8px;
            width: 100%;
        }
        
        .info td {
            padding: 1px 3px;
        }
        
        .info .label {
            font-weight: bold;
            width: 70px;
        }
        
        /* Wrapper tabel dengan space kiri kanan */
        .table-wrapper {
            margin: 0 5mm;
        }
        
        table.data {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        table.data th {
            background-color: #2c3e50;
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 5px 2px;
            border: 0.5px solid #2c3e50;
            font-size: 7px;
            text-transform: uppercase;
            vertical-align: middle;
        }
        
        table.data td {
            padding: 4px 2px;
            border: 0.5px solid #ddd;
            vertical-align: top;
            font-size: 8px;
            word-wrap: break-word;
            overflow: hidden;
        }
        
        table.data tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .badge {
            display: inline-block;
            padding: 1px 3px;
            border-radius: 2px;
            font-size: 6px;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
            line-height: 1;
        }
        
        .badge-success { background-color: #28a745; }
        .badge-secondary { background-color: #6c757d; }
        .badge-info { background-color: #17a2b8; }
        .badge-dark { background-color: #343a40; }
        .badge-warning { background-color: #ffc107; color: #000; }
        
        .footer {
            margin-top: 15px;
            padding-top: 8px;
            border-top: 0.5px solid #ddd;
            font-size: 7px;
            color: #666;
            text-align: center;
        }
        
        /* ✅ KOLOM BARU + LAMA - Total 14 kolom */
        .col-no { width: 3%; }
        .col-induk { width: 9%; }
        .col-nama { width: 12%; }
        .col-panggilan { width: 8%; }
        .col-jk { width: 3%; }
        .col-ttl { width: 10%; }
        .col-telp { width: 9%; }
        .col-nikah { width: 8%; }
        .col-baptis { width: 5%; }
        .col-status { width: 7%; }
        .col-alamat { width: 12%; }
        /* ✅ 3 KOLOM BARU */
        .col-gabung { width: 8%; }      /* Tanggal Bergabung */
        .col-hubungan { width: 8%; }   /* Hubungan Keluarga */
        .col-pendidikan { width: 8%; } /* Pendidikan Terakhir */
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>DATA JEMAAT GEREJA</h1>
        <p>Yayasan Mutiara Kasih Karunia</p>
    </div>
    
    <!-- Info -->
    <table class="info">
        <tr>
            <td class="label">Tanggal</td>
            <td>: {{ now()->translatedFormat('d F Y') }}</td>
            <td class="label text-right">Total</td>
            <td class="text-right">: {{ $jemaats->count() }} orang</td>
        </tr>
        <tr>
            <td class="label">Waktu</td>
            <td>: {{ now()->format('H:i') }} WIB</td>
            <td class="label text-right">Admin</td>
            <td class="text-right">: {{ auth()->guard('admin')->user()->name ?? 'Admin' }}</td>
        </tr>
    </table>
    
    <!-- Tabel dengan 14 Kolom -->
    <div class="table-wrapper">
        <table class="data">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-induk">No. Induk</th>
                    <th class="col-nama">Nama Lengkap</th>
                    <th class="col-panggilan">Panggilan</th>
                    <th class="col-jk">JK</th>
                    <th class="col-ttl">Tempat/Tgl Lahir</th>
                    <th class="col-telp">Telepon</th>
                    <th class="col-nikah">Status Nikah</th>
                    <th class="col-baptis">Baptis</th>
                    <th class="col-status">Status</th>
                    <th class="col-alamat">Alamat</th>
                    <!-- ✅ 3 KOLOM BARU -->
                    <th class="col-gabung">Tgl Gabung</th>
                    <th class="col-hubungan">Hub Keluarga</th>
                    <th class="col-pendidikan">Pendidikan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jemaats as $index => $jemaat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $jemaat->nomor_induk ?? '-' }}</td>
                    <td><strong>{{ Str::limit($jemaat->nama_lengkap, 20) }}</strong></td>
                    <td>{{ $jemaat->nama_panggilan ?? '-' }}</td>
                    <td class="text-center">
                        {{ $jemaat->jenis_kelamin == 'L' ? 'L' : ($jemaat->jenis_kelamin == 'P' ? 'P' : '-') }}
                    </td>
                    <td>
                        {{ Str::limit($jemaat->tempat_lahir, 10) ?? '' }}
                        @if($jemaat->tanggal_lahir)
                            <br><small>{{ $jemaat->tanggal_lahir->format('d/m/Y') }}</small>
                        @endif
                    </td>
                    <td>{{ $jemaat->no_telp ?? '-' }}</td>
                    <td>{{ Str::limit($jemaat->status_perkawinan, 10) ?? '-' }}</td>
                    <td class="text-center">
                        @if($jemaat->sudah_baptis)
                            <span class="badge badge-success">✓</span>
                        @else
                            <span class="badge badge-secondary">-</span>
                        @endif
                    </td>
                    <td>
                        @switch($jemaat->status_jemaat)
                            @case('aktif')
                                <span class="badge badge-success">Aktif</span>
                                @break
                            @case('tidak_aktif')
                                <span class="badge badge-secondary">Nonaktif</span>
                                @break
                            @case('pindah')
                                <span class="badge badge-info">Pindah</span>
                                @break
                            @case('meninggal')
                                <span class="badge badge-dark">Meninggal</span>
                                @break
                        @endswitch
                    </td>
                    <td>{{ Str::limit($jemaat->alamat, 25) ?? '-' }}</td>
                    <!-- ✅ 3 KOLOM DATA BARU -->
                    <td class="text-center">
                        {{ $jemaat->tanggal_bergabung?->format('d/m/Y') ?? '-' }}
                    </td>
                    <td>
                        {{ Str::limit($jemaat->hubungan_keluarga, 10) ?? '-' }}
                    </td>
                    <td>
                        {{ Str::limit($jemaat->pendidikan_terakhir, 12) ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="14" class="text-center" style="padding: 15px;">
                        Tidak ada data jemaat
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p>© {{ now()->year }} Yayasan Mutiara Kasih Karunia | Generated: {{ now()->format('H:i:s') }}</p>
    </div>
</body>
</html>