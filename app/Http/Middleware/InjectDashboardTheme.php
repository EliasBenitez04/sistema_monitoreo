<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InjectDashboardTheme
{
    /**
     * Inject the isolated dashboard stylesheet into standalone dashboard views.
     *
     * These screens currently render their own complete HTML document and use
     * Bootstrap 5, so loading the AdminLTE bundle would create CSS conflicts.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $routeName = optional($request->route())->getName();

        if (! $routeName || ! Str::startsWith($routeName, 'dashboard.')) {
            return $response;
        }

        if (! method_exists($response, 'getContent') || ! method_exists($response, 'setContent')) {
            return $response;
        }

        $content = $response->getContent();

        if (! is_string($content) || ! Str::contains($content, '</head>')) {
            return $response;
        }

        $stylesheet = '<link rel="stylesheet" href="' . asset('css/dashboard-v3.css') . '?v=3">';

        $response->setContent(
            Str::replaceLast('</head>', $stylesheet . PHP_EOL . '</head>', $content)
        );

        return $response;
    }
}
