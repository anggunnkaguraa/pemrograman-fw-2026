<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
       if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            // Menampilkan halaman error kustom (buat file view errors/unauthorized.blade.php)
            return response()->view('errors.unauthorized', [], 403);
       }
        return $next($request);
    }
}

