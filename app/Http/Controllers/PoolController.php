<?php

namespace App\Http\Controllers;

use App\Pool;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_id = auth()->user()->currentTeam->id;
        $pools = Pool::where('team_id', $team_id)->get();
        
        return response()->json([
            'status' => '200',
            'data' => $pools
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
            'team_id' => auth()->user()->currentTeam->id,
            'name' => 'required',
            'size' => 'required',
            'coordinates' => 'required'
        ]);
        $pool = Pool::create($request->all());

        return redirect()->back()->with('message', 'Piscina Guardada!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function show(Pool $pool)
    {
        return Pool::findOrFail($pool);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function edit(Pool $pool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pool $pool)
    {
        $request->validate([
            'team_id' => auth()->user()->currentTeam->id,
            'name' => 'required',
            'size' => 'required',
            'coordinates' => 'required'
        ]);

        Pool::where('id', $request->id)->update($request->all());
        
        return redirect()->back()->with('message', 'Piscina Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pool $pool)
    {
        $pool = Pool::findOrFail($pool);
        $pool->delete();

        return redirect()->back()->with('message', 'Piscina Eliminada!');
    }
}
