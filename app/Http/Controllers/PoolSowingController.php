<?php

namespace App\Http\Controllers;

use App\PoolSowing;
use App\Pool;
use App\Sowing;
use App\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PoolSowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_id = auth()->user()->currentTeam->id;
        $pools_sowed = DB::table('pools_sowing')
                            ->join('pools', 'pools_sowing.pool_id','=','pools.id')
                            ->select('pools_sowing.*','pools.name as pool_name')
                            ->get();

        $pools = Pool::where('team_id', $team_id)->get();
        $resources = Resource::where('team_id', $team_id)->get();
        $presentations = DB::table('presentation_resources')->get();
        $inventory = DB::table('inventory_resources as inventory')
                            ->join('resources','inventory.resource_id','=','resources.id')
                            ->join('presentation_resources as presentation','inventory.presentation_id','=','presentation.id')
                            ->select('inventory.*','resources.name as resource_name','presentation.name as presentation_name','presentation.unity as presentation_unity')
                            ->get();
        return view('vendor.spark.sowing')->with(['pools_sowed' => $pools_sowed,
                                                    'pools' => $pools,
                                                    'inventory' => $inventory,
                                                    'resources' => $resources,
                                                    'presentations' => $presentations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pool_id' => 'required',
            'planted_larvae' => 'required',
            'larvae_type' => 'required',
            'planted_at' => 'required'
        ]);
        $sowing = PoolSowing::create($request->all());

        return redirect()->back()->with('message', 'Siembra Guardada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PoolSowing  $poolSowing
     * @return \Illuminate\Http\Response
     */
    public function show(PoolSowing $poolSowing)
    {
        return PoolSowing::findOrFail($poolSowing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PoolSowing  $poolSowing
     * @return \Illuminate\Http\Response
     */
    public function edit(PoolSowing $poolSowing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PoolSowing  $poolSowing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'pool_id' => 'required',
            'planted_larvae' => 'required',
            'larvae_type' => 'required',
            'planted_at' => 'required'
        ]);
        $poolSowed = PoolSowing::find($request->id);
        $poolSowed->update($request->except('_token','_method'));   
        return redirect()->back()->with('message', 'Siembra de Piscina Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PoolSowing  $poolSowing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        $pool_sowed = PoolSowing::findOrFail($request->id);
        $pool_sowed->delete();

        return redirect()->back()->with('message', 'Siembra de Piscina Eliminada!');
    }

    //Inventory methods

    public function storeInventory(Request $request)
    {
        $request->validate([
            'resource_id' => 'required',
            'quantity' => 'required',
            'presentation_id' => 'required',
            'team_id' => 'required'
        ]);
        $inventory = Sowing::create($request->all());

        return redirect()->back()->with('message', 'Agregado al inventario!');
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
