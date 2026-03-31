<?php
// app/Http/Controllers/Admin/StatsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        return view('admin.stats', [
            'totalVisits'        => Visit::count(),
            'visitsToday'        => Visit::whereDate('visited_at', today())->count(),
            'visitsThisWeek'     => Visit::whereBetween('visited_at', [now()->startOfWeek(), now()])->count(),
            'visitsThisMonth'    => Visit::whereMonth('visited_at', now()->month)->count(),
            'uniqueVisitorsToday'=> Visit::whereDate('visited_at', today())->distinct('ip_address')->count('ip_address'),
            'popularPages'       => Visit::select('url', DB::raw('count(*) as total'))
                                        ->groupBy('url')->orderByDesc('total')->limit(10)->get(),
            'recentVisits'       => Visit::orderByDesc('visited_at')->limit(20)->get(),
            'dailyStats'         => Visit::select(DB::raw('DATE(visited_at) as date'), DB::raw('count(*) as total'))
                                        ->where('visited_at', '>=', now()->subDays(30))
                                        ->groupBy('date')->orderBy('date')->get(),
        ]);
    }
}
