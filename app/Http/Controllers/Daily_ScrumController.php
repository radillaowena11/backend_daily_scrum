<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Daily_Scrum;

class Daily_ScrumController extends Controller
{
    public function daily_scrum() {
        $data = "Data All daily scrum";
        return response()->json($data, 200);
    }

    public function daily_scrumAuth() {
        $data = "Welcome " . Auth::user()->name;
        return response()->json($data, 200);
    }
    
}














    



    // public function index() {
    //     $data = Daily::all();
    //     return response($data);
    // }
    // public function show($id) {
    //     $data = Daily::where('id', $id)->get();
    //     return response ($data);
    // }
    // public function store(Request $request){
    //     try{
    //         $data = new Daily();
    //         $data->id_user = $request->input('id_user');
    //         $data->gambar = $photo; //belum diganti
    //         $data->activity_yesterday = $request->input('activity_yesterday ');
    //         $data->activity_today = $request->input('activity_today');
    //         $data->problem_yesterday = $request->input('problem_yesterday');
    //         $data->solution = $request->input('solution');
    //         $data->save();
    //         return response()->json([
    //             'status' => '1',
    //             'message' => 'Tambah data Daily Scrum berhasil'
    //         ]);
    //     }catch(\Exception $e) {
    //         return response()->json([
    //             'status' => '0',
    //             'message' => 'Tambah data Daily Scrum gagal'
    //         ]);
    //     }
    // }
    // public function update(Request $request, $id) {
    //     try{
    //         $data = Daily::where('id', $id)->first();
    //         $data->id_user = $request->input('id_user');
    //         $data->gambar = $photo; //belum diganti
    //         $data->activity_yesterday = $request->input('activity_yesterday ');
    //         $data->activity_today = $request->input('activity_today');
    //         $data->problem_yesterday = $request->input('problem_yesterday');
    //         $data->solution = $request->input('solution');

    //         return response()->json([
    //             'status' => '1',
    //             'message' => 'Ubah data Daily Scrum berhasil'
    //         ]);
    //     }catch(\Exception $e) {
    //         return response()->json([
    //             'status' => '0',
    //             'message' => 'Ubah data Daily Scrum gagal'
    //         ]);
    //     }catch(\Exception $e) {
    //         return response()->json([
    //             'status'    => '0',
    //             'message'   => $e->getMessage()
    //         ]);
    //     }
    // }
    // public function destroy($id){
    //     try{
    //         $data = Daily::where('id', $id)->first();
    //         $data->delete();

    //         return response()->json([
    //             'status' => '1',
    //             'message' => 'Hapus data Daily Scrum berhasil'
    //         ]);
    //     }catch(\Exception $e) {
    //         return response()->json([
    //             'status' => '0',
    //             'message' => 'Hapus data Daily Scrum gagal'
    //         ]);
    //     }