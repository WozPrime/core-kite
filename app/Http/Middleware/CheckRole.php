<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next,...$roles)
    {
        if (in_array($request->user()->role,$roles)){
            return $next($request);
        }
        return redirect('/');
    }

    // public function handle ($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->check()) {
    //         $role =Auth::user()->role;

    //         switch ($role) {
    //             case 'admin':
    //                 return redirect ('/admin');
    //             break;

    //             case'teacher':
    //                 return redirect('/teacher');
    //                 break;

    //             case 'student':
    //                 return redirect ('student');
    //                 break;

    //             // default:
    //             //     return redirect('/student');
    //             //     break;

    //     }
    // }
    //     return $next($request);
    // }


}
