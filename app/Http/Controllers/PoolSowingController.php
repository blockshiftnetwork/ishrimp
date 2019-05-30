<?php

namespace App\Http\Controllers;

use App\PoolSowing;
use App\Pool;
use App\Sowing;
use App\Resource;
use App\DaylySample;
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
        
        return view('vendor.spark.sowing')->with(['pools_sowed' => $pools_sowed,
                                                    'pools' => $pools,
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
        $pool_id = PoolSowing::get()->last();
        $this->saveSampleToPool($pool_id);
        return redirect()->back()->with('message', 'Siembra Guardada!');
    }
 public function saveSampleToPool($pool_id)
    {
        $sample = new DaylySample;
        $sample->pool_id = $pool_id->pool_id;
        $sample->abw = 0;
        $sample->wg = 0;
        $sample->weight = 0;
        $sample->quantity = 0;
        $sample->survival_percent = 0;
        $sample->abw_date = $pool_id->planted_at;
        $sample->abw_hour = '0:00:00';
        $sample->save();
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

  
}
