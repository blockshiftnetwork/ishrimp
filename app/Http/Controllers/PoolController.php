<?php

namespace App\Http\Controllers;

use App\Pool;
use App\DaylySample;
use Illuminate\Support\Facades\DB;
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
      
        $pools_summary = DB::table('pools')->where('pools.team_id', $team_id)
                            ->join('daily_samples as samples','samples.pool_id','=','pools.id')
                            ->leftJoin('pools_sowing as sowing', 'pools.id','=', 'sowing.pool_id' )
                            ->select('pools.*',DB::raw('(DATEDIFF(CURDATE(),sowing.planted_at)) as days'),'sowing.planted_larvae',
                                DB::raw('(SELECT SUM(pools_resources_used.quantity) FROM pools_resources_used, resources WHERE pools_resources_used.pool_id = pools.id and pools_resources_used.resource_id = resources.id and resources.category_id = 1 ) as balanced'),'samples.abw','samples.wg','samples.survival_percent as survival')->get();

                            //dd($pools_summary);
        return response()->json([
            'status' => '200',
            'data' => $pools_summary
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
