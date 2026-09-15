<?php

namespace Tests\Unit\Http;

use App\Http\Middleware\InjectDashboardTheme;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Tests\TestCase;

class InjectDashboardThemeTest extends TestCase
{
    public function test_it_injects_dashboard_stylesheet_on_dashboard_routes(): void
    {
        $request = Request::create('/dashboard/test', 'GET');
        $route = new Route(['GET'], '/dashboard/test', fn () => null);
        $route->name('dashboard.test');
        $request->setRouteResolver(fn () => $route);

        $response = (new InjectDashboardTheme())->handle(
            $request,
            fn () => response('<html><head><title>Dashboard</title></head><body></body></html>')
        );

        $this->assertStringContainsString('css/dashboard-v3.css?v=3', $response->getContent());
    }

    public function test_it_does_not_inject_stylesheet_on_regular_routes(): void
    {
        $request = Request::create('/home', 'GET');
        $route = new Route(['GET'], '/home', fn () => null);
        $route->name('home');
        $request->setRouteResolver(fn () => $route);

        $response = (new InjectDashboardTheme())->handle(
            $request,
            fn () => response('<html><head><title>Home</title></head><body></body></html>')
        );

        $this->assertStringNotContainsString('dashboard-v3.css', $response->getContent());
    }
}
