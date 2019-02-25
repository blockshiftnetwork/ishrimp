<?php

namespace App\Http\Controllers;

use App\PoolSowing;
use Illuminate\Http\Request;

class PoolSowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $id)
    {
         $pools_sowed = PoolSowing::where('pool_id', $id)->get();
        
        return response()->json([
            'status' => '200',
            'data' => $pools_sowed
        ]);
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
    public function update(Request $request, PoolSowing $poolSowing)
    {
        $request->validate([
            'pool_id' => 'required',
            'planted_larvae' => 'required',
            'larvae_type' => 'required',
            'planted_at' => 'required'
        ]);

        PoolSowing::where('id', $request->id)->update($request->all());
        
        return redirect()->back()->with('message', 'Siembra de Piscina Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PoolSowing  $poolSowing
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoolSowing $poolSowing)
    {
        $pool_sowed = PoolSowing::findOrFail($poolSowing);
        $pool_sowed->delete();

        return redirect()->back()->with('message', 'Siembra de Piscina Eliminada!');
    }
}
