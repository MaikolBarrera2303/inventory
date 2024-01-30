<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view("users.index",[
            "users" => User::paginate(10),
            "roles" => Role::all()
            ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $request->validate([
            "email" => Rule::unique(User::class),
            "password" => "confirmed",
        ],[
            "email.unique" => "El Correo ya existe",
            "password.confirmed" => "Las Contraseñas no coinciden"
        ]);
        try {
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "role_id" => $request->role_id,
                "password" => Hash::make($request->password),
            ]);
            return redirect(route("users.index"))->with("success","Usuario Creado");
        }
        catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR USER STORE : ".json_encode($throwable->getMessage()));
            return redirect(route("users.index"))->with("error","Error al crear el usuario");
        }
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, User $user): Redirector|RedirectResponse|Application
    {
        $request->validate(["email" => Rule::unique(User::class)->ignore($user->id)],["email.unique" => "El Correo ya existe"]);
        try{
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "role_id" => $request->role_id,
            ]);
            return redirect(route("users.index"))->with("success","Usuario Actualizado");
        }
        catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR USER UPDATE : ".json_encode($throwable->getMessage()));
            return redirect(route("users.index"))->with("error","Error al actualizar el usuario");
        }
    }

    /**
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(User $user): Redirector|RedirectResponse|Application
    {
        try {
            $user->delete();
            return redirect(route("users.index"))->with("success","Usuario Eliminado");
        }
        catch (Throwable $throwable) {
            Log::channel("error_inventory")->error("ERROR USER DESTROY : ".json_encode($throwable->getMessage()));
            logger("Error eliminando usuario: ".$throwable->getMessage());
            return redirect(route("users.index"))->with("error","Error al eliminar el usuario");
        }
    }
}
