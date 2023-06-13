<?php

namespace App\Http\Middleware;

use App\Models\AdminModel;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next)
    {
        $email = Cookie::get('login_email');
        $password = Cookie::get('login_pass');

        if (!empty($email) && !empty($password)) {

            $check = AdminModel::where('email', $email)->first();

            if (!empty($check)) {
                $data2 = AdminModel::where('email', $email)->where('flag', '0')->first();

                if (!empty($data2)) {
                    if ($password == $data2->password) {

                        Cookie::queue('login_email', $email, time() + 60 * 60 * 24 * 100);
                        Cookie::queue('login_pass', $password, time() + 60 * 60 * 24 * 100); 

                    } else {
                        Session::flash('message', 'Your Password is updated. Please login again');
                        return redirect('/');
                    }
                } else {
                    Session::flash('message', 'Your account is deactivated by Admin. Please contact admin');
                    return redirect('/');
                }
            } else {
                Session::flash('message', 'Email address not found');
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

        return $next($request);
    }
}
