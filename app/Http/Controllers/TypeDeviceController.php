<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\TypeDevice;
use App\Models\Validation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Throwable;

class TypeDeviceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view("type-devices.index",[
            "typeDevices" => (new Api())->index("type-devices",request("page"))
        ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $validation = (new Validation)->typeDevice();
        $request->validate($validation["validate"],$validation["message"]);
        try 
        {
            $response = (new Api)->store("type-devices",$request->toArray());
            return redirect(route("type-devices.index"))->with($response["type"],$response["message"]);
        }
        catch (Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR TYPE_DEVICE STORE : ".json_encode($throwable->getMessage()));
            return  redirect(route("type-devices.index"))->with("error","Error API");
        }
    }

    /**
     * @param TypeDevice $typeDevice
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id): Redirector|RedirectResponse|Application
    {
        try {
            $response = (new Api)->destroy("type-devices/".$id);
            return redirect(route("type-devices.index"))->with($response["type"],$response["message"]);
        }
        catch (Throwable $throwable) {
            Log::channel("error_inventory")->error("ERROR TYPE_DEVICES DESTROY : ".json_encode($throwable->getMessage()));
            return redirect(route("type-devices.index"))->with("error","Error Eliminando el dispositivo");
        }
    }
}
