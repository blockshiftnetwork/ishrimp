<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cultivation;
use App\Pool;
use App\Resource;
use App\PresentationResource;
use App\Laboratory;

class CultivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $team_id = auth()->user()->currentTeam->id;
        $pools = Pool::select('id', 'name')->where('team_id', $team_id)->get();
        $resources = Resource::select('id', 'name')->where('team_id', $team_id)->get();
        $laboratories = Laboratory::select('id', 'name')->get();
        return view('vendor.spark.cultivation')->with(['pools' => $pools, 'resources' => $resources,'laboratories' => $laboratories]);  
    }

    public function getPresentationResource($resource_id)
    {        
        $presentation = PresentationResource::where('resource_id', $resource_id)->get();
        return response()->json([
            'status' => '200',
            'data' => $presentation,
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
            'resource_id' => 'required',
            'quantity' => 'required',
            'presentation_id' => 'required',
            'date' => 'required'
        ]);

        $cultivation = new Cultivation;
        $cultivation->pool_id = $request->pool_id;
        $cultivation->resource_id = $request->resource_id;
        $cultivation->quantity = $request->quantity;
        $cultivation->presentation_id = $request->presentation_id;
        $cultivation->note = $request->note;
        $cultivation->date = $request->date;
        $cultivation->save();

        return response()->json([
            'status' => '200',
            'data' => 'Recurso guardado!',
        ]); 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pool $pool)
    {
    }
    ###Dayly Parameters##
    public function storeDaylyParam(Request $request)
    {
        $request->validate([
            'pool_id' => 'required',
            'ph' => 'required',
            'ppt' => 'required',
            'ppm' => 'required',
            'temperature' => 'required',
            'co3' => 'required',
            'hco3' => 'required',
            'ppm_d' => 'required',
            'ppm_a' => 'required',
            'ppm_h' => 'required',
            'green_colonies' => 'required',
            'yellow_colonies' => 'required',
        ]);

     dd($resquest);
        }
}
