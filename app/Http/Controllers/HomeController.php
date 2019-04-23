<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pool;
use App\PoolSowing;
use App\DaylySample;
use App\DaylyParameters;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');

        // $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $pools = [];
        $pool_id = Pool::get()->last();
        $team_id = auth()->user()->currentTeam->id;
        $isExistsParam = DB::table('daily_parameters')->
            join('pools','daily_parameters.pool_id','=','pools.id')->where('pools.id',$pool_id)->where('pools.team_id', $team_id)->exists();
            
        if($isExistsParam){
        $pools = DB::table('pools')->where('team_id','=', $team_id)
                    ->leftjoin('pools_sowing as sowing', 'pools.id','=', 'sowing.pool_id' )
                    ->leftJoin('daily_samples as samples', 'pools.id','=', 'samples.pool_id')->where('samples.id', DB::raw('(SELECT MAX(samples.id) FROM daily_samples as samples WHERE samples.pool_id = pools.id)'))
                    ->leftJoin('daily_parameters as parameters', 'pools.id','=', 'parameters.pool_id' )->where('parameters.id', DB::raw('(SELECT MAX(parameters.id) FROM daily_parameters as parameters WHERE parameters.pool_id = pools.id)'))
                    ->groupBy('pool_id')
                    ->select('pools.id as pool_id', 'pools.name as name', DB::raw('(IFNULL(sowing.planted_at, 0)) as planted_at'), DB::raw('(IFNULL(samples.abw,0)) as abw'), DB::raw('(IFNULL(samples.wg, 0)) as awg'), DB::raw('(IFNULL(samples.survival_percent, 0)) as survival'),
                        DB::raw('(IFNULL((DATEDIFF(CURDATE(),sowing.planted_at)),0)) as days'), DB::raw('(IFNULL(sowing.planted_larvae, 0)) as planted_larvae'),
                        DB::raw('(SELECT (IFNULL(SUM(pools_resources_used.quantity),0)) FROM pools_resources_used, resources WHERE pools_resources_used.pool_id = pools.id and pools_resources_used.resource_id = resources.id and resources.category_id = 1 ) as balanced'), DB::raw('(IFNULL(parameters.ppm, 0)) as do'))
                    ->get();
            }else{

                $pools = DB::table('pools')->where('team_id','=', $team_id)
                    ->leftjoin('pools_sowing as sowing', 'pools.id','=', 'sowing.pool_id' )
                    ->leftJoin('daily_samples as samples', 'pools.id','=', 'samples.pool_id')->where('samples.id', DB::raw('(SELECT MAX(samples.id) FROM daily_samples as samples WHERE samples.pool_id = pools.id)'))
                    ->leftJoin('daily_parameters as parameters', 'pools.id','=', 'parameters.pool_id' )
                    ->groupBy('pool_id')
                    ->select('pools.id as pool_id', 'pools.name as name', DB::raw('(IFNULL(sowing.planted_at, 0)) as planted_at'), DB::raw('(IFNULL(samples.abw,0)) as abw'), DB::raw('(IFNULL(samples.wg, 0)) as awg'), DB::raw('(IFNULL(samples.survival_percent, 0)) as survival'),
                        DB::raw('(IFNULL((DATEDIFF(CURDATE(),sowing.planted_at)),0)) as days'), DB::raw('(IFNULL(sowing.planted_larvae, 0)) as planted_larvae'),
                        DB::raw('(SELECT (IFNULL(SUM(pools_resources_used.quantity),0)) FROM pools_resources_used, resources WHERE pools_resources_used.pool_id = pools.id and pools_resources_used.resource_id = resources.id and resources.category_id = 1 ) as balanced'), DB::raw('(IFNULL(parameters.ppm, 0)) as do'))
                    ->get(); 
            }
        $resources = DB::table('resources')->where('resources.category_id','>', 1)->get();
        $balanceds = DB::table('resources')->where('resources.category_id','=', 1)->get();

            //dd($resources);
        return view('home')->with(['pools' => $pools, 'resources' => $resources,'balanceds' => $balanceds]);
    }
}
