<?php

namespace App\Http\Controllers;

use App\Http\Requests\Responsibles\StoreResponsibleRequest;
use App\Http\Requests\Responsibles\UpdateResponsibleRequest;
use App\Models\Api;
use App\Models\Responsible;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Throwable;

class ResponsibleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        try
        {
            return view("responsibles.index",[
                "responsibles" => (new Api)->index("responsibles",request("page"))
            ]);
        }
        catch(Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR RESPONSIBLE INDEX : ".json_encode($throwable->getMessage()));
            return redirect(route("logout"))->with("error","Error API");
        }
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreResponsibleRequest $request)
    {
        try 
        {
            $response = (new Api)->store("responsibles",$request->toArray());
            return redirect(route("responsibles.index"))->with($response["type"],$response["message"]);
        }
        catch (Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR RESPONSIBLE STORE : ".json_encode($throwable->getMessage()));
            return redirect(route("responsibles.index"))->with("error","Error API");
        }
    }

    /**
     * @param Request $request
     * @param Responsible $responsible
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateResponsibleRequest $request, $id)
    {
        try {
            $response = (new Api)->update("responsibles/".$id,$request->toArray());
            return redirect(route("responsibles.index"))->with($response["type"],$response["message"]);
        }
        catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR TYPE DEVICE UPDATE : ".json_encode($throwable->getMessage()));
            return redirect(route("responsibles.index"))->with("error","Error API");
        }
    }

    /**
     * @param Responsible $responsible
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id): Redirector|RedirectResponse|Application
    {
        try 
        {
            $response = (new Api)->destroy("responsibles/".$id);
            return redirect(route("responsibles.index"))->with($response["type"],$response["message"]);
        }
        catch (Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR RESPONSIBLE DESTROY : ".json_encode($throwable->getMessage()));
            return redirect(route("responsibles.index"))->with("error","Error API");
        }
    }
}
