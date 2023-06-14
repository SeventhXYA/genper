<!DOCTYPE html>
<html>

<head>
    <title>Daftar Surat Masuk</title>
    <style>
        table {
            width: 100%;
            font-size: 11pt;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        .hiding {
            position: fixed;
            margin-top: -13px
        }
    </style>

</head>

<body>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="hiding">

        <img src="assets/images/headerweekly.png" width="700">

    </div>
    <div align="center" style="margin-top: 120px">
        <h2>PROGRESS UNIT BISNIS KOPERASI BINA USAHA PERMATA</h2>
        <h3>{{ \Carbon\Carbon::parse($startDate)->format('d-M-Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d-M-Y') }}</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th style="width:5rem">Tanggal</th>
                <th style="width:15rem">Divisi</th>
                <th>Deskripsi Kegiatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $weekly)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($weekly->start_date)->format('d-M-Y') }}</td>
                    <td align="center">{{ $weekly->akundivisi->divisi->divisi }}</td>
                    <td align="center">{{ $weekly->rencana }}</td>
                    <td align="center">
                        @if ($weekly->status == 0)
                            <span>Berjalan</span>
                        @elseif($weekly->status == 1)
                            <span>Selesai</span>
                        @else
                            <span>Tidak Selesai</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
