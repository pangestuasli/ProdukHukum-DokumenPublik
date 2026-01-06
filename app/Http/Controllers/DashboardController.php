<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\DokumenHukum;
use App\Models\RiwayatPerubahan;
use App\Models\LampiranDokumen;
use App\Models\Warga;
use App\Models\User;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statistik utama
        $totalDokumen = DokumenHukum::count();
        $totalJenis = JenisDokumen::count();
        $totalKategori = KategoriDokumen::count();
        $totalLampiran = LampiranDokumen::count();
        $totalWarga = Warga::count();
        $totalUser = User::count();
        
        // Dokumen terbaru
        $dokumenTerbaru = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->latest()
            ->limit(5)
            ->get();
            
        // Riwayat perubahan terbaru
        $riwayatTerbaru = RiwayatPerubahan::with('dokumenHukum')
            ->latest()
            ->limit(5)
            ->get();
            
        // Statistik dokumen per status
        $dokumenPerStatus = DokumenHukum::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();
            
        // Data untuk chart (dokumen per bulan - tahun ini)
        $currentYear = date('Y');
        $dokumenPerBulan = DokumenHukum::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('tanggal', $currentYear)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
            
        // Format data untuk chart
        $chartData = [];
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $chartLabels = [];
        $chartValues = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $chartLabels[] = $bulanLabels[$i - 1];
            $found = $dokumenPerBulan->where('bulan', $i)->first();
            $chartValues[] = $found ? $found->total : 0;
        }
        
        $chartData['labels'] = $chartLabels;
        $chartData['values'] = $chartValues;
        $chartData['year'] = $currentYear;

        return view('dashboard.index', compact(
            'totalDokumen',
            'totalJenis',
            'totalKategori',
            'totalLampiran',
            'totalWarga',
            'totalUser',
            'dokumenTerbaru',
            'riwayatTerbaru',
            'dokumenPerStatus',
            'chartData'
        ));
    }
    
    public function getDashboardStats(Request $request)
    {
        // API endpoint untuk data real-time
        $period = $request->get('period', 'month');
        
        $stats = [
            'total_dokumen' => DokumenHukum::count(),
            'total_dokumen_baru' => DokumenHukum::whereDate('created_at', '>=', Carbon::now()->subDays(7))->count(),
            'total_lampiran' => LampiranDokumen::count(),
            'total_riwayat' => RiwayatPerubahan::count(),
            'total_warga' => Warga::count(),
            'total_user' => User::count(),
            'updated_at' => now()->format('Y-m-d H:i:s')
        ];
        
        return response()->json($stats);
    }
}