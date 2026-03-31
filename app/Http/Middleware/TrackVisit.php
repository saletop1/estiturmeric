<?php
// app/Http/Middleware/TrackVisit.php
namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;

class TrackVisit
{
    public function handle(Request $request, Closure $next)
    {
        // Skip bots & admin
        $ua = $request->userAgent() ?? '';
        $skip = ['bot','crawl','spider','slurp','DuckDuckBot','Baiduspider'];
        foreach ($skip as $s) {
            if (stripos($ua, $s) !== false) return $next($request);
        }

        Visit::create([
            'url'        => $request->path() ?: '/',
            'ip_address' => $request->ip(),
            'user_agent' => substr($ua, 0, 255),
            'referer'    => $request->headers->get('referer'),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
