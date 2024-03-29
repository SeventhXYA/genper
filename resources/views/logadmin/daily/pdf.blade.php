<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN KEGIATAN HARIAN {{ $sesi }}</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
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
            /* position: fixed; */
            margin-top: -13px
        }
    </style>

</head>

<body>
    <div class="hiding">
        <img src="assets/images/headerweekly.png" width="700">
    </div>
    <div align="center">
        <h2>LAPORAN KEGIATAN HARIAN {{ $sesi }}</h2>
        <h3>{{ \Carbon\Carbon::parse($startDate)->format('d-M-Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d-M-Y') }}</h3>
    </div>

    @php
        $previousUser = null;
    @endphp

    @foreach ($data as $key => $daily)
        @php
            $currentUser = $daily->user->id;
            $isFirstRow = $key === 0;
            $isSameUser = $currentUser === $previousUser;
        @endphp

        @if (!$isFirstRow && !$isSameUser)
            </tbody>
            </table>
            <div class="page-break"></div>
        @endif

        @if (!$isSameUser)
            <div class="row">
                <div class="col-sm-4 ">
                    Dari
                    <address>
                        <strong>{{ $daily->user->nm_depan }} {{ $daily->user->nm_belakang }}</strong><br>
                        {{ $daily->user->divisi->divisi }}<br>
                        {{ $daily->user->nohp }}<br>
                        Email: {{ $daily->user->email }} <br><br>
                    </address>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 5rem">Tanggal</th>
                        <th>Rencana</th>
                        <th>Aktual</th>
                    </tr>
                </thead>
                <tbody>
        @endif

        <tr>
            <td>{{ $daily->created_at->format('d-M-Y') }}</td>
            <td>{{ $daily->rencana }}</td>
            <td>{{ $daily->aktual }}</td>
        </tr>

        @php
            $previousUser = $currentUser;
        @endphp

        @if ($loop->last)
            </tbody>
            </table>
        @endif
    @endforeach
    <div style="margin-top: 50px;">
        <div style="text-align: right; margin-bottom:5px">
            <b>Asamasam, {{ date('d-M-Y') }}</b>
        </div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 33%; text-align: center;">
                    <strong>Pembina Generasi Permata:</strong><br>
                    <!-- Tempat untuk Nama atau NIP -->
                </td>
                <td style="width: 33%; text-align: center;">
                    <strong>Di Review Oleh:</strong><br>
                    <!-- Tempat untuk Nama atau NIP -->
                </td>
                <td style="width: 33%; text-align: center;">
                    <strong>Mengetahui:</strong><br>
                    <!-- Tempat untuk Nama atau NIP -->
                </td>
            </tr>
            <tr>
                <td style="width: 33%; text-align: center;">
                    <br><br><br><br><br>
                    Raka Pradipta Permadi
                </td>
                <td style="width: 33%; text-align: center;">
                    <br><br><br><br><br>
                    HPMT
                </td>
                <td style="width: 33%; text-align: center;">
                    <br><br><br><br><br>
                    PT Arutmin Indonesia Tambang Asamasam
                </td>
            </tr>
        </table>
    </div>

</body>


</html>
