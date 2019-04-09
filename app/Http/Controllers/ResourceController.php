<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Provider;
use App\PresentationResource;
use App\Laboratory;
use App\Sowing;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\DB;
class ResourceController extends Controller
{
    public function index()
    {
        $team_id = auth()->user()->currentTeam->id;
        $resources = DB::table('resources')->where('resources.team_id','=', $team_id)
                    ->join('category_resources as category', 'resources.category_id','=', 'category.id' )
                    ->join('providers','resources.provider_id','=','providers.id')
                    ->select('resources.*', 'category.name as category_name',
                            'providers.name as provider_name')
                    ->get();

        $presentations = DB::table('presentation_resources as presentation')
                        ->join('resources', 'presentation.resource_id','=','resources.id')
                        ->select('resources.name as resource_name','presentation.*')
                        ->get();

        $inventory = DB::table('inventory_resources as inventory')
                        ->join('resources','inventory.resource_id','=','resources.id')
                        ->join('presentation_resources as presentation','inventory.presentation_id','=','presentation.id')
                        ->select('inventory.*','resources.name as resource_name','presentation.name as presentation_name','presentation.unity as presentation_unity','presentation.quantity as presentation_quantity')
                        ->get();

        $categories = DB::table('category_resources')->get();
        $providers = Provider::all();
        $laboratories = Laboratory::all();
        return view('vendor.spark.resource-settings')->with(['resources' => $resources,
                                                            'providers' => $providers,
                                                            'categories' => $categories,
                                                            'presentations' => $presentations,
                                                            'inventory' => $inventory,
                                                            'laboratories' => $laboratories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'provider_id' => 'required',
            'team_id' => 'required'
        ]);

        $Resource = Resource::create($request->all());

        return redirect()->back()->with('message', '¡Recurso Guardado!');
    }

    public function show($id)
    {
        return Resource::findOrFail($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'provider_id' => 'required',
            'team_id' => 'required'
        ]);

        $resource = Resource::find($request->id);
        $resource->update($request->except('_token','_method'));
        
        return redirect()->back()->with('message', '¡Recurso Actualizado!');
    }

    public function destroy(Request $request)
    {
        $resource = Resource::findOrFail($request->id);
        $resource_used = DB::table('pools_resources_used')->where('resource_id',$request->id);
        $presentation = DB::table('presentation_resources')->where('resource_id',$request->id);
        $presentation->delete();
        $resource_used ->delete();
        $resource->delete();

        return redirect()->back()->with('message', '¡Recurso Eliminado!');
    }

    /*##### Providers Methods #####*/

    public function storeProvider(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required'
        ]);

        $Provider = Provider::create($request->all());

        return redirect()->back()->with('message', '¡Proveedor Guardado!');
    }

    public function showProvider($id)
    {
        return Provider::findOrFail($id);
    }


    public function updateProvider(Request $request)
    { 
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required'
        ]);
        $provider = Provider::find($request->id);
        $provider->update($request->except('_token','_method'));
        
        return redirect()->back()->with('message', '¡Proveedor Actualizado!');
    }

    public function destroyProvider(Request $request)
    {
        $Provider = Provider::findOrFail($request->id);
        $Provider->delete();

        return redirect()->back()->with('message', '¡Proveedor Eliminado!');
    }

    /*##### Presentation Methods #####*/

    public function storePresentation(Request $request)
    {
     
        $request->validate([
            'resource_id'=> 'required',
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'unity' => 'required'
        ]);
        $presentation = PresentationResource::create($request->all());

        return redirect()->back()->with('message', '¡Presentación Guardada!');
    }

    public function showPresentation($id)
    {
        return PresentationResource::findOrFail($id);
    }


    public function updatePresentation(Request $request)
    { 
        $request->validate([
            'resource_id'=> 'required',
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'unity' => 'required'
        ]);
        $presentation = PresentationResource::find($request->id);
        $presentation->update($request->except('_token','_method'));
        
        return redirect()->back()->with('message', '¡Presentación Actualizada!');
    }

    public function destroyPresentation(Request $request)
    {
        $presentation = PresentationResource::findOrFail($request->id);
        $presentation->delete();

        return redirect()->back()->with('message', '¡Presentación Eliminada!');
    }

     /*##### Laboratories Methods #####*/

     public function storeLaboratory(Request $request)
     {
      
         $request->validate([
             'name' => 'required',
             'phone' => 'required',
             'address' => 'required',
             'email' => 'required'
         ]);
         $laboratory = Laboratory::create($request->all());
 
         return redirect()->back()->with('message', '¡Laboratorio Guardado!');
     }
 
     public function showLaboratory($id)
     {
         return laboratory::findOrFail($id);
     }
 
 
     public function updateLaboratory(Request $request)
     { 
         
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required'
        ]);
         $laboratory = Laboratory::find($request->id);
         $laboratory->update($request->except('_token','_method'));
         
         return redirect()->back()->with('message', '¡Laboratorio Actualizado!');
     }
 
     public function destroyLaboratory(Request $request)
     {
         $laboratory = Laboratory::findOrFail($request->id);
         $laboratory->delete();
 
         return redirect()->back()->with('message', '¡Laboratorio Eliminado!');
     }

       ##Inventory methods###

    public function storeInventory(Request $request)
    {
        $request->validate([
            'resource_id' => 'required',
            'quantity' => 'required',
            'presentation_id' => 'required',
            'team_id' => 'required'
        ]);
        $inventory = Sowing::create($request->all());

        return redirect()->back()->with('message', '¡Agregado al inventario!');
    }

 
    public function showInventory(PoolSowing $poolSowing)
    {
        return Sowing::findOrFail($poolSowing);
    }

    public function updateInventory(Request $request)
    {
        $request->validate([
            'resource_id' => 'required',
            'quantity' => 'required',
            'presentation_id' => 'required',
            'team_id' => 'required'
        ]);
        $inventory = Sowing::find($request->id);
        $inventory->update($request->except('_token','_method'));   
        return redirect()->back()->with('message', 'Inventario Actualizado!');
    }

    public function destroyInventory(Request $request )
    {
        $inventory = Sowing::findOrFail($request->id);
        $inventory->delete();

        return redirect()->back()->with('message', 'Eliminado del Inventario!');
    }
}
