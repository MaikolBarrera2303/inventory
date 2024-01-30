<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view("auth.login");
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function login(Request $request)
    {
        try {
            $user = User::where("email",$request->user)->first();
            if ($user && Hash::check($request->password,$user->password)){
                Auth::login($user,$request->boolean("remember"));
                return redirect(route("devices.index"));
            }
            return redirect(route("login"))->with("error","Credenciales incorrectas");


        }catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR AUTH LOGIN : ".json_encode($throwable->getMessage()));
            return redirect(route("login"))->with("error","Error al iniciar sesion");
        }
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(Request $request): Redirector|RedirectResponse|Application
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            session()->invalidate();
            session()->regenerate();

            return redirect(route("login"));

        }catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR AUTH LOGOUT : ".json_encode($throwable->getMessage()));
            return redirect(route((explode("/",$request->header()["referer"][0]))[3].".index"))
                ->with("error","Error al Cerrar Sesion");
        }
    }
}
