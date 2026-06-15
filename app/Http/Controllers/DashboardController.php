<?php

namespace App\Http\Controllers;

use App\Models\PostViewAnalytics;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i)->toDateString());

        $viewsRaw = PostViewAnalytics::select('viewed_at', DB::raw('count(*) as total'))
            ->where('viewed_at', '>=', now()->subDays(6)->toDateString())
            ->groupBy('viewed_at')
            ->pluck('total', 'viewed_at');

        $uniqueRaw = PostViewAnalytics::select('viewed_at', DB::raw('count(distinct ip_address) as total'))
            ->where('viewed_at', '>=', now()->subDays(6)->toDateString())
            ->groupBy('viewed_at')
            ->pluck('total', 'viewed_at');

        $labels = $days->map(fn ($d) => Carbon::parse($d)->format('D'));
        $pageViews = $days->map(fn ($d) => $viewsRaw[$d] ?? 0);
        $uniqueVisitors = $days->map(fn ($d) => $uniqueRaw[$d] ?? 0);

        return view('Dashboard', compact('user', 'labels', 'pageViews', 'uniqueVisitors'));
    }

    public function traffic(Request $request)
    {
        $range = $request->input('range', 'week');

        $days = match ($range) {
            'day' => collect(range(23, 0))->map(fn ($i) => now()->subHours($i)->format('Y-m-d H:00:00')),
            'week' => collect(range(6, 0))->map(fn ($i) => now()->subDays($i)->toDateString()),
            'month' => collect(range(29, 0))->map(fn ($i) => now()->subDays($i)->toDateString()),
        };

        $start = match ($range) {
            'day' => now()->subHours(23),
            'week' => now()->subDays(6),
            'month' => now()->subDays(29),
        };

        $viewsRaw = PostViewAnalytics::select('viewed_at', DB::raw('count(*) as total'))
            ->where('viewed_at', '>=', $start->toDateString())
            ->groupBy('viewed_at')
            ->pluck('total', 'viewed_at');

        $uniqueRaw = PostViewAnalytics::select('viewed_at', DB::raw('count(distinct ip_address) as total'))
            ->where('viewed_at', '>=', $start->toDateString())
            ->groupBy('viewed_at')
            ->pluck('total', 'viewed_at');

        $labels = $days->map(fn ($d) => Carbon::parse($d)->format($range === 'day' ? 'H:i' : ($range === 'month' ? 'M d' : 'D')));
        $pageViews = $days->map(fn ($d) => $viewsRaw[substr($d, 0, 10)] ?? 0);
        $uniqueVisitors = $days->map(fn ($d) => $uniqueRaw[substr($d, 0, 10)] ?? 0);

        return response()->json([
            'labels' => $labels->values(),
            'pageViews' => $pageViews->values(),
            'uniqueVisitors' => $uniqueVisitors->values(),
        ]);
    }
}
