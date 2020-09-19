<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm(){    
        return view('auth.login');
    }  

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //este metodo sobreescribe al definido en el trait AuthenticatesUsers ubicado en \vendor\laravel\framework\src\Illuminate\Foundation\Auth
    public function username(){    
        //cambio realizado para tener en cuenta el nombre de usuario en lugar del email 
        return 'username';
    }

    //añado esta función login para validar el estado del usuario al momento de loguear
    
    public function login(\Illuminate\Http\Request $request) {
        $this->validateLogin($request);
    
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
    
        // This section is the only change
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
    
            // Make sure the user is active
            if ($user->estado && $this->attemptLogin($request)) {
                // Send the normal successful login response
                return $this->sendLoginResponse($request);
            } else {
                // Increment the failed login attempts and redirect back to the
                // login form with an error message.
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([$this->username()=> 'El usuario se encuentra inactivo, por favor contactese con el administrador.']);
                    // ->withErrors(['estado' => 'Debes estar activo para ingresar.']);
            }
        }
    
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
    
        return $this->sendFailedLoginResponse($request);
    }

    //añadi esto para validar la redirección del loguin si el usuario es standar, el coigo siguiente fue sacado del RedirectsUsers.php
    public function redirectPath()
    {
        //lo comenté porque se cambio la pantalla de bienvenida y se queria mostrar algo al usuario standar.
        // if (Auth::user()->rol == 0) {
        //     return '/tickets/ver_tickets';
        // }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
