<?php

namespace App\Http\Controllers;

use App\Http\Requests\Devices\StoreDeviceRequest;
use App\Http\Requests\Devices\UpdateDeviceRequest;
use App\Models\Api;
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
        try
        {
            return view("devices.index",[
                "devices" => (new Api())->index("devices",request("page"))
            ]);
        }
        catch(Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR INDEX DEVICE : ".json_encode($throwable->getMessage()));
            return redirect(route("logout"))->with("error","Error API");
        }
    }

    /**
     * 
     */
    public function create()
    {
        try
        {
            $response = (new Api())->create("devices");
            return view("devices.create",[
                "responsibles" => $response["responsibles"],
                "typeDevices" => $response["typeDevices"],
            ])->with("error" , (is_array($response)) ? null : $response);
        }
        catch(Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR CREATE DEVICE : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreDeviceRequest $request): Redirector|RedirectResponse|Application
    {
        try 
        {
            $response = (new Api)->store("devices",$request->toArray());
            return redirect(route("devices.index"))->with($response["type"],$response["message"]);
        }
        catch (Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR STORE DEVICE : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }

    /**
     * @param Device $device
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        try
        {
            return view("devices.show",[
                "device" => (new Api)->show("devices/".$id)
            ]);
        }
        catch(Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR SHOW DEVICE : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }

    /**
     * @param Device $device
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {
        try
        {
            $response =  (new Api)->edit("devices/".$id);
            return view("devices.edit",[
                "responsibles" => $response->query["responsibles"],
                "typeDevices" =>  $response->query["typeDevices"],
                "device" => $response->info,
                "typeMemory" => Str::after($response->info["memory"]," ")
            ]);

        }
        catch(Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR EDIT DEVICE : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }

    /**
     * @param Request $request
     * @param Device $device
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateDeviceRequest $request, $id): Redirector|RedirectResponse|Application
    {
        try 
        {
            $response = (new Api)->update("devices/".$id,$request->toArray());
            return redirect(route("devices.index"))->with($response["type"],$response["message"]);
        }
        catch(Throwable $throwable)
        {
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
        try 
        {
            $response = (new Api)->destroy("devices/".$id);
            return redirect(route("devices.index"))->with($response["type"],$response["message"]);
        }
        catch (Throwable $throwable)
        {
            Log::channel("error_inventory")->error("ERROR DESTROY DEVICE : ".json_encode($throwable->getMessage()));
            return redirect(route("devices.index"))->with("error","Error API");
        }
    }
}
