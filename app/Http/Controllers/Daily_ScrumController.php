<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Daily_Scrum;
use DB;
use Illuminate\Support\Facades\Validator;

class Daily_ScrumController extends Controller
{
    public function index()
    {
    	try{
	        $data["count"] = Daily_Scrum::count();
	        $daily_scrum = array();
	        $dataDaily_Scrum = DB::table('daily_scrum')->join('users','users.id','=','daily_scrum.id_users')
                                               ->select('daily_scrum.id', 'daily_scrum.id_users','users.firstname','users.lastname','users.email',
                                               'daily_scrum.role','daily_scrum.activity_yesterday','daily_scrum.activity_today',
                                               'daily_scrum.problem_yesterday','daily_scrum.solution')
	                                           ->get();

	        foreach ($dataDaily_Scrum as $p) {
	            $item = [
                    "id"         	     => $p->id,
                    "id_users"            => $p->id_users,
                    "firstname"          => $p->firstname,
                    "lastname"           => $p->lastname,
                    "email"              => $p->email,
                    "role"               => $p->role,
                    "activity_yesterday" => $p->activity_yesterday,
                    "activity_today"     => $p->activity_today,
                    "problem_yesterday"  => $p->problem_yesterday,
                    "solution"           => $p->solution,
	            ];

	            array_push($daily_scrum, $item);
	        }
	        $data["daily_scrum"] = $daily_scrum;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function getAll($limit = 10, $offset = 0, $id_users)
    {
    	try{
	        $data["count"] = Daily_Scrum::count();
	        $daily_scrum = array();
	        $dataDaily_Scrum = DB::table('daily_scrum')->join('users','users.id','=','daily_scrum.id_users')
                                               ->select('daily_scrum.id', 'daily_scrum.id_users','users.firstname','users.lastname','users.email',
                                               'daily_scrum.role','daily_scrum.activity_yesterday','daily_scrum.activity_today',
                                               'daily_scrum.problem_yesterday','daily_scrum.solution')
                                               ->skip($offset)
                                               ->take($limit)
	                                           ->get();

	        foreach ($dataDaily_Scrum as $p) {
	            $item = [
                    "id"         	     => $p->id,
                    "id_users"            => $p->id_users,
                    "firstname"          => $p->firstname,
                    "lastname"           => $p->lastname,
                    "email"              => $p->email,
                    "role"               => $p->role,
                    "activity_yesterday" => $p->activity_yesterday,
                    "activity_today"     => $p->activity_today,
                    "problem_yesterday"  => $p->problem_yesterday,
                    "solution"           => $p->solution,
	            ];

	            array_push($daily_scrum, $item);
	        }
	        $data["daily_scrum"] = $daily_scrum;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function store(Request $request)
    {
      try{
    		$validator = Validator::make($request->all(), [
        'id_users'            => 'required|numeric',
    		'role'                => 'required|string|max:255',
				'activity_yesterday'	=> 'required|string|max:255',
        'activity_today'  		=> 'required|string|max:255',
        'problem_yesterday'	 	=> 'required|string|max:255',
				'solution'	      		=> 'required|string|max:255',
    		]);

    		if($validator->fails()){
    			return response()->json([
    				'status'	=> 0,
    				'message'	=> $validator->errors()
    			]);
    		}

    		if(User::where('id', $request->input('id_users'))->count() > 0){
    			$data = new Daily_Scrum();
            	$data->id_users = $request->input('id_users');
			    $data->role = $request->input('role');
			    $data->activity_yesterday = $request->input('activity_yesterday');
			    $data->activity_today = $request->input('activity_today');
                $data->problem_yesterday = $request->input('problem_yesterday');
                $data->solution = $request->input('solution');
			    $data->save();

		    	return response()->json([
		    		'status'	=> '1',
		    		'message'	=> 'Daily scrum berhasil ditambahkan!'
		    	], 201);
    		} else {
    			return response()->json([
		            'status' => '0',
		            'message' => 'Daily srum gagal ditambahkan.'
		        ]);
    		}
    		
        } catch(\Exception $e){
            return response()->json([
                'status' => '0',
                'message' => $e->getMessage()
            ]);
        }
  	}


    public function delete($id)
    {
        try{

            $delete = Daily_Scrum::where("id", $id)->delete();
            if($delete){
              return response([
                "status"  => 1,
                  "message"   => "Data berhasil dihapus."
              ]);
            } else {
              return response([
                "status"  => 0,
                  "message"   => "Data gagal dihapus."
              ]);
            }
            
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
                "message"   => $e->getMessage()
            ]);
        }
    }
}