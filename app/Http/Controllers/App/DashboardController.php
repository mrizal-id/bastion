<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('brand')) {
            return $this->brandDashboard($user);
        }

        return $this->clientDashboard($user);
    }

    private function clientDashboard($user)
    {
        // Statistik khusus Client
        $stats = [
            'active_projects' => Project::where('client_id', $user->id)
                ->where('project_status', 'active')
                ->count(),
            'pending_reviews' => Project::where('client_id', $user->id)
                ->where('project_status', 'completed')
                ->whereDoesntHave('review')
                ->count(),
        ];

        $recent_projects = Project::where('client_id', $user->id)
            ->with('brand.ratingSummary') // Load rating brand untuk ditampilkan di list
            ->latest()
            ->limit(5)
            ->get();

        return view('app.dashboard', compact('stats', 'recent_projects'));
    }

    private function brandDashboard($user)
    {
        // Eager load ratingSummary agar tidak N+1 query
        $brand = $user->brand()->with('ratingSummary')->first();

        // Proteksi jika User punya role Brand tapi profil Brand belum dibuat
        if (!$brand) {
            return redirect()->route('app.profile.setup')
                ->with('info', 'Silahkan lengkapi profil Brand Anda terlebih dahulu.');
        }

        $stats = [
            'new_orders'      => Project::where('brand_id', $brand->id)
                ->where('project_status', 'pending')
                ->count(),
            'total_earnings'  => Project::where('brand_id', $brand->id)
                ->where('project_status', 'completed')
                ->sum('total_budget'), // Sesuaikan dengan nama kolom di migrasi (total_budget)
            'average_rating'  => $brand->ratingSummary->average_rating ?? 0,
            'total_portfolio' => Portfolio::where('brand_id', $brand->id)->count(),
        ];

        $recent_projects = Project::where('brand_id', $brand->id)
            ->with('client')
            ->latest()
            ->limit(5)
            ->get();

        return view('app.dashboard', compact('stats', 'recent_projects', 'brand'));
    }
}
