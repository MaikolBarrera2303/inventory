<?php

namespace App\Http\Controllers;

use App\Models\Responsible;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class ResponsibleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view("responsibles.index",[
            "responsibles" => Responsible::orderBy("name","asc")->paginate(10)
        ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $request->validate([
            "name" => Rule::unique(Responsible::class),
            "account" => Rule::unique(Responsible::class),
        ],[
            "name.unique" => "Ya existe el responsable",
            "account.unique" => "Ya existe la cuenta",
        ]);
        try {
            Responsible::create([
                "name" => $request->name,
                "account" => $request->account,
                "phone" => $request->phone,
            ]);
            return redirect(route("responsibles.index"))->with("success","Responsable creado");
        }
        catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR RESPONSIBLE STORE : ".json_encode($throwable->getMessage()));
            return redirect(route("responsibles.index"))->with("error","Error al crear");
        }
    }

    /**
     * @param Request $request
     * @param Responsible $responsible
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Responsible $responsible): Redirector|RedirectResponse|Application
    {
        $request->validate([
            "name" => Rule::unique(Responsible::class)->ignore($responsible->id),
            "account" => Rule::unique(Responsible::class)->ignore($responsible->id),
        ],[
            "name.unique" => "El nombre ya existe",
            "account.unique" => "La cuenta ya existe",
        ]);
        try {
            $responsible->update([
                "name" => $request->name,
                "account" => $request->account,
                "phone" => $request->phone,
            ]);
            return redirect(route("responsibles.index"))->with("success","Responsable Editado");
        }
        catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR TYPE DEVICE UPDATE : ".json_encode($throwable->getMessage()));
            return redirect(route("responsibles.index"))->with("error","Error al Actualizar");
        }
    }

    /**
     * @param Responsible $responsible
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Responsible $responsible): Redirector|RedirectResponse|Application
    {
        try {
            $responsible->delete();
            return redirect(route("responsibles.index"))->with("success","Responsable Eliminado");
        }
        catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR RESPONSIBLE DESTROY : ".json_encode($throwable->getMessage()));
            return redirect(route("responsibles.index"))->with("error","Error al Eliminar");
        }
    }
}
