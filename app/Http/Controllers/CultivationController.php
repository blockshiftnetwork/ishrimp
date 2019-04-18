<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cultivation;
use App\Pool;
use App\Resource;
use App\PresentationResource;
use App\Laboratory;
use App\DaylyParameters;
use App\DaylySample;
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

        $dailySamples = DB::table('daily_samples')->latest()
                            ->join('pools','pools.id','=','daily_samples.pool_id')->where('pools.team_id',$team_id)
                            ->select('daily_samples.*','pools.name as pool_name')
                            ->get();
                            
        return view('vendor.spark.cultivation')->with(['pools' => $pools, 'resources' => $resources,
                                                        'laboratories' => $laboratories, 'dailySamples'=> $dailySamples]);  
    }

    public function getPresentationResource($resource_id)
    {        
        $presentation = PresentationResource::where('resource_id', $resource_id)->get();
        return response()->json([
            'status' => '200',
            'data' => $presentation,
        ]);
    }

    public function verifyExistence($resource_id, $presentation_id){

        $existence = DB::table('inventory_resources')->where([
                                ['resource_id', '=', $resource_id],
                                ['presentation_id', '=', $presentation_id],
                                ])
                                ->select('inventory_resources.quantity')->get();
        return response()->json([
                'status' => '200',
                'data' => $existence,
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
            'data' => '!Recursos Agregados!',
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
            'laboratory_id' => 'required',
            'date' => 'required',
            'hour' => 'required'
        ]);
        $dayly = DaylyParameters::create($request->all());
        return response()->json([
            'status' => '200',
            'data' => '!Datos guardados!',
        ]); 
        }

  ###Dayly ABW##
  public function storeDaylyABW(Request $request)
  {
      $request->validate([
          'pool_id' => 'required',
          'abw' => 'required',
          'wg' => 'required',
          'survival_percent' => 'required',
          'abw_date' => 'required',
          'abw_hour' => 'required',
      ]);
      //$very = DB::table('daily_samples')->where('pool_id', $request->pool_id)->get();
      //if(count($very) > 0){
        //$daylySample = DaylySample::where('pool_id', $request->pool_id)->update($request->except('_token'));
      //}else{
        $daylySample = DaylySample::create($request->except('_token'));
      //}
      return response()->json([
          'status' => '200',
          'data' => '!Datos guardados!',
      ]); 
      }

}
