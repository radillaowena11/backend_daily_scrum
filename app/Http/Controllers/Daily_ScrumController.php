<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Daily_Scrum;

class Daily_ScrumController extends Controller
{
    public function index($id)
    {
        try{
            $dataUser = User::where('id', $id)->first();
            if($dataUser != NULL){
            $data["count"] = Daily_Scrum::count();
            $daily_Scrum = array();
            $dataDailyScrum = DB::table('daily_scrum')->join('user','user.id','=','daily_scrum.id_user')
                                               ->select('daily_scrum.id', 'user.firstname', 'user.lastname', 'daily_scrum.team', 'daily_scrum.activity_yesterday', 'daily_scrum.activity_today', 'daily_scrum.problem_yesterday', 'daily_scrum.solution')
                                               ->where('daily_scrum.id_user','=', $id)
                                               ->get();
                                               
    
            foreach ($dataDaily_Scrum as $p) {
                $item = [
                    "id_users"          		=> $p->id_users,
                    "firstname"  		=> $p->firstname,
                    "lastname"  		=> $p->lastname,
                    "role"    	  		=> $p->role,
                    "activity_yesterday"  => $p->activity_yesterday,
                    "activity_today"  		=> $p->activity_today,
                    "problem_yesterday"  			=> $p->problem_yesterday,
                    "solution" 			=> $p->solution
                ];
    
                array_push($dailyScrum, $item);
            }
            $data["daily_Scrum"] = $daily_Scrum;
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
    

    public function store(Request $request){
        try{
            $data = new Daily_Scrum();
            $data->id_users = $request->input('id_users');
            $data->role = $request->input('role');
            $data->activity_yesterday = $request->input('activity_yesterday');
            $data->activity_today = $request->input('activity_today');
            $data->problem_yesterday = $request->input('problem_yesterday');
            $data->solution = $request->input('solution');
            $data->save();
            return response()->json([
                'status' => '1',
                'message' => 'Tambah data Daily Scrum berhasil'
            ]);
        }catch(\Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Tambah data Daily Scrum gagal'
            ]);
        }
    }

    public function destroy($id){
        try{
            $data = Daily_Scrum::where('id', $id)->first();
            $data->delete();

            return response()->json([
                'status' => '1',
                'message' => 'Hapus data Daily_Scrum berhasil'
            ]);
        }catch(\Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Hapus data Daily_Scrum gagal'
            ]);
        }
}
}
