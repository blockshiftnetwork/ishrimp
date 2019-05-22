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
        $resources = Resource::select('id', 'resource_name')->where('team_id', $team_id)->get();
        
        $laboratories = Laboratory::select('id', 'name')->get();

        $dailySamples = DB::table('daily_samples')->where('daily_samples.id', DB::raw('(SELECT MAX(samples.id) FROM daily_samples as samples WHERE samples.pool_id = pools.id)'))
                            ->join('pools','pools.id','=','daily_samples.pool_id')->where('pools.team_id',$team_id)
                            ->select('daily_samples.*','pools.name as pool_name')->groupBy('daily_samples.pool_id')
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

        $existence = DB::table('inventory_resources as inventory')->where('inventory.id', DB::raw('(SELECT MAX(inventory.id) FROM inventory_resources as inventory WHERE inventory.resource_id = resources.id)'))
                        ->join('resources','inventory.resource_id','=','resources.id')->where('inventory.resource_id',$resource_id)
                        ->join('presentation_resources as presentation','inventory.presentation_id','=','presentation.id')->where('inventory.presentation_id',$presentation_id)
                        ->select('inventory.quantity','inventory.id','resources.resource_name as resource_name','presentation.name as presentation_name','presentation.unity as presentation_unity','presentation.quantity as presentation_quantity', DB::raw('(SELECT IFNULL(SUM(used.quantity),0) from pools_resources_used as used where used.resource_id = inventory.resource_id) as used_quatity' ))->groupBy('presentation_quantity')->get();

                        //dd($existence);
        /*DB::table('inventory_resources')->where([
                                ['resource_id', '=', $resource_id],
                                ['presentation_id', '=', $presentation_id],
                                ])
                                ->select('inventory_resources.quantity', DB::raw('(SELECT IFNULL(SUM(used.quantity),0) from pools_resources_used as used where used.resource_id = inventory_resources.resource_id) as used_quatity' ))->get();*/
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
    public function update(Request $request)
    {
        $request->validate([
            'pool_id' => 'required',
            'resource_id' => 'required',
            'quantity' => 'required',
            'presentation_id' => 'required',
            'date' => 'required'
        ]);

        $used = DB::table('pools_resources_used')->where('pools_resources_used.id',$request->id)
                    ->update($request->except('_token','_method'));
        
        return redirect()->back()->with('message', '¡Recurso Actualizado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $used = DB::table('pools_resources_used')->where('pools_resources_used.id',$request->id)
                ->delete();

        return redirect()->back()->with('message', '¡Recurso Eliminado!');
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

    public function updateDaylyParam(Request $request)
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
           // dd($request);
            $dayly = DB::table('daily_parameters')->where('daily_parameters.id',$request->id)
                        ->update($request->except('_token','_method'));
    
            return redirect()->back()->with('message', 'Datos Actualizados!');
    
        }
    
        
    public function destroyDaylyParam(Request $request)
        {
            $dayly = DB::table('daily_parameters')->where('daily_parameters.id',$request->id)
                        ->delete();
    
            return redirect()->back()->with('message', 'Datos Eliminados!');
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

      public function updateDaylyABW(Request $request)
      {
       
        $request->validate([
            'pool_id' => 'required',
            'abw' => 'required',
            'wg' => 'required',
            'survival_percent' => 'required',
            'abw_date' => 'required',
            'abw_hour' => 'required',
        ]);
        
          $dayly = DB::table('daily_samples')->where('daily_samples.id',$request->id)
                      ->update($request->except('_token','_method'));
  
          return redirect()->back()->with('message', 'Datos Actualizados!');
  
      }
  
      
  public function destroyDaylyABW(Request $request)
      {
          $dayly = DB::table('daily_samples')->where('daily_samples.id',$request->id)
                      ->delete();
  
          return redirect()->back()->with('message', 'Datos Eliminados!');
      }

 ## Projections ##
    public function storeProjections(Request $request)
    {
         $request->validate([
         'pool_id' => 'required',
         'parameter' => 'required',
         'theoretical' => 'required',
        ]);
    
        $projection = DB::table('projections_data')->insert($request->except('_token'));
         return response()->json([
            'status' => '200',
            'data' => '!Datos guardados!',
        ]); 
    }

    public function getProjections($pool_id, $parameter_id)
    {
        if($parameter_id == 1){
            $projection = DB::table('projections_data as projection')->where('projection.pool_id', $pool_id)->where('projection.parameter', $parameter_id)
                                    ->join('daily_samples as sample','sample.pool_id', 'projection.pool_id')
                                    ->select('projection.*','sample.abw', DB::raw('(SELECT (IFNULL(SUM(pools_resources_used.quantity),0)) FROM pools_resources_used, resources WHERE pools_resources_used.pool_id = pools.id and pools_resources_used.resource_id = resources.id and resources.category_id = 1 ) as balanced'))->orderBy('week')->get();
        }elseif($parameter_id == 2){
            $projection = DB::table('projections_data as projection')->where('projection.pool_id', $pool_id)->where('projection.parameter', $parameter_id)
                                    ->join('pools_resources_used as used','used.pool_id', 'projection.pool_id')
                                    ->select('projection.*','used.quantity')->orderBy('week')->get();
        }else{
            $projection = DB::table('projections_data as projection')->where('projection.pool_id', $pool_id)->where('projection.parameter', $parameter_id)
            ->join('daily_samples as sample','sample.pool_id', 'projection.pool_id')
            ->select('projection.*','sample.survival_percent as survival')->orderBy('week')->get();
        }
        
           dd($projection);

            return response()->json([
            'status' => '200',
            'data' => $projection,
        ]); 
     }
}
