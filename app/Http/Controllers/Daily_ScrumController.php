<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Daily_Scrum;
use DB;
use Illuminate\Support\Facades\Validator;

class Daily_ScrumController extends Controller
{
    public function index($id)
    {
    	try{
            $dataUser = User::where('id', $id)->first();
            if($dataUser != NULL){
	        $data["count"] = Daily_Scrum::count();
	        $daily_scrum = array();
            $dataDaily_Scrum = DB::table('daily_scrum')->join('users','users.id','=','daily_scrum.id_users')
                                               ->where('daily_scrum.id_users','=', $id)
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

        } else {
            return response([
              'status' => 0,
              'message' => 'Data User tidak ditemukan'
            ]);
          }

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
                                               ->where('daily_scrum.id_users', $id_users)
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

    public function store (Request $request){
        try {
            $data = new Daily_Scrum();
            $data->id_users 	          = $request->input('id_users');
            $data->role 	              = $request->input('role');
            $data->activity_yesterday 	= $request->input('activity_yesterday');
            $data->activity_today       = $request->input('activity_today');
            $data->problem_yesterday    = $request->input('problem_yesterday');
            $data->solution             = $request->input('solution');
            $data->save();
            return response()->json([
                'status'    => '1',
                'message'   => 'Tambah Daily Scrum Berhasil!'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status'    => '0',
                'message'   =>  'Tambah Daily Scrum Gagal!'
  
            ]);
        }
    }    

    public function destroy($id){
        try {
            $data = Daily_Scrum::where('id',$id)->first();
            $data->delete();
            
            return response()->json([
                'status'    => '1',
                'message'   => 'Hapus Data Barang Berhasil!'
            ]);
        } catch(\Exception $e) {
            return response()->jsoon([
                'status'    => '0',
                'message'   => 'Hapus Data Barang Gagal!'
            ]);
        }
      }
    }