<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Provider;
use App\Http\Controllers\ProviderController;

class ResourceController extends Controller
{
    public function index()
    {
        $team_id = auth()->user()->currentTeam->id;
        $resources = Resource::where('team_id', $team_id)->get();
        $providers = Provider::all();
        return view('vendor.spark.resource-settings')->with(['resources' => $resources, 'providers' => $providers]);
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

        return redirect()->back()->with('message', 'Recurso Guardado!');
    }

    public function show($id)
    {
        return Resource::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'provider_id' => 'required',
            'team_id' => 'required'
        ]);
    
        $resource = Resource::find($request->id);
        $resource->update($request->except('_token','_method'));
        
        return redirect()->back()->with('message', 'Recurso Actualizado!');
    }

    public function destroy($id)
    {
        $resource = Resource::findOrFail($request->id);
        $resource->delete();

        return redirect()->back()->with('message', 'Recurso Eliminado!');
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

        return redirect()->back()->with('message', 'Proveedor Guardado!');
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
        
        return redirect()->back()->with('message', 'Proveedor Actualizado!');
    }

    public function destroyProvider(Request $request)
    {
        $Provider = Provider::findOrFail($request->id);
        $Provider->delete();

        return redirect()->back()->with('message', 'Proveedor Eliminado!');
    }
}
