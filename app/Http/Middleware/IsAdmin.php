<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $checkAuth = DB::table('users')
            ->select('roles.name')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.id', '=', auth()->id())
            ->first()->name ?? 'user';
        if ($checkAuth == 'admin') {
            return $next($request);
        }
        return redirect()
            ->back()
            ->with('unauthorized', 'You are unauthorized to perform this action.');
    }
}
