<?php

namespace App\Http\Controllers;

use App\Dailysd;
use App\Weekly;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = Weekly::whereBetween('created_at', [$startDate, $endDate])->orderBy('id_akundivisi', 'ASC')->get();

        // $start = $startDate;
        // $end = $endDate;

        $pdf = Pdf::loadView('logadmin.weekly.pdf', compact('data', 'startDate', 'endDate'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('data.pdf');
    }

    public function generatePdfSd(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $sesi = 'SELF-DEVELOPMENT';

        $data = Dailysd::whereBetween('created_at', [$startDate, $endDate])->orderBy('user_id', 'ASC')->get();

        $pdf = Pdf::loadView('logadmin.daily.pdf', compact('data', 'sesi', 'startDate', 'endDate'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('data.pdf');
    }
}
