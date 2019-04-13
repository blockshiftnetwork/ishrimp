<?php

namespace App\Http\Controllers;

use App\Pool;
use App\DaylySample;
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
            'name' => 'required',
            'size' => 'required',
            'coordinates' => 'required'
        ]);
        
        $pool = new Pool;
        $pool->team_id = auth()->user()->currentTeam->id;
        $pool->name = $request->name;
        $pool->size = $request->size;
        $pool->coordinates = $request->coordinates;
        $pool->save();
        $pool_id = Pool::get()->last(); 
       $this->saveSampleToPool($pool_id);
        return redirect()->back()->with('message', 'Piscina Guardada!');
    }

    public function saveSampleToPool($pool_id)
    {
        $sample = new DaylySample;
        $sample->pool_id = $pool_id->id;
        $sample->abw = 0;
        $sample->wg = 0;
        $sample->weight = 0;
        $sample->quantity = 0;
        $sample->survival_percent = 0;
        $sample->abw_date = '2000-01-01';
        $sample->abw_hour = '0:00:00';
        $sample->save();
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'coordinates' => 'required'
        ]);
        
        $pool = Pool::find($id) ;
        $pool->team_id = auth()->user()->currentTeam->id;
        $pool->name = $request->name;
        $pool->size = $request->size;
        $pool->coordinates = $request->coordinates;
        $pool->save();

        return redirect()->back()->with('message', 'Piscina Guardada!');
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
