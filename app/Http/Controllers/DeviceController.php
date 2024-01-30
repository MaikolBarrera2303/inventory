<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\Validation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class DeviceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("devices.index",[
            "devices" => (new Api())->index("devices",request("page"))
        ]);
    }

    /**
     * 
     */
    public function create()
    {
        $response = (new Api())->create("devices");

        return view("devices.create",[
            "responsibles" => $response["responsibles"],
            "typeDevices" => $response["typeDevices"],
        ])->with("error" , (is_array($response)) ? null : $response);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $validation = (new Validation())->device("store",null);
        $request->validate($validation["validate"],$validation["message"]);
        try {
            $response = (new Api)->store("devices",$request->toArray());
            return redirect(route("devices.index"))->with($response["type"],$response["message"]);
        }catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR DEVICE STORE : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }

    /**
     * @param Device $device
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        return view("devices.show",[
            "device" => (new Api)->show("devices/".$id)
        ]);
    }

    /**
     * @param Device $device
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {
        $response =  (new Api)->edit("devices/".$id);

        return view("devices.edit",[
            "responsibles" => $response->query["responsibles"],
            "typeDevices" =>  $response->query["typeDevices"],
            "device" => $response->info,
            "typeMemory" => Str::after($response->info["memory"]," ")
        ]);
    }

    /**
     * @param Request $request
     * @param Device $device
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id): Redirector|RedirectResponse|Application
    {
        $validation = (new Validation())->device("update",$id);
        $request->validate($validation["validate"],$validation["message"]);

        try {
            $response = (new Api)->update("devices/".$id,$request->toArray());
            return redirect(route("devices.index"))->with($response["type"],$response["message"]);
        }catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR UPDATE DEVICE : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }

    /**
     * @param Device $device
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(string $id): Redirector|RedirectResponse|Application
    {
        try {
            $response = (new Api)->destroy("devices/".$id);
            return redirect(route("devices.index"))->with($response["type"],$response["message"]);
        }catch (Throwable $throwable){
            Log::channel("error_inventory")->error("ERROR DEVICE DESTROY : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }
}
