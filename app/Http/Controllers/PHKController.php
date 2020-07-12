<?php

namespace App\Http\Controllers;

use App\PHK;
use Illuminate\Http\Request;

class PHKController extends Controller
{
    public function index()
    {
        $phk = PHK::get();
        $response = [
            'status' => 'Success',
            'message' => $phk
        ];
        return response()->json($response,200);
    }

    public function rekap()
    {
        $total = PHK::count();
        $konfirmasi = PHK::where('status_data', 'Terkonfirmasi')->count();
        $belumkonfirmasi = PHK::where('status_data', 'Belum Dikonfirmasi')->count();
        $rekap = ['total' => $total, 'konfirmasi' => $konfirmasi, 'belumkonfirmasi' => $belumkonfirmasi];
        $response = [
            'status' => 'Success',
            'message' => $rekap
        ];
        return response()->json($response,200);
    }

    public function tambah(Request $request)
    {
        $phk = new PHK;
        $phk->no_kk = $request['no_kk'];
        $phk->nik = $request['nik'];
        $phk->sebelum = $request['sebelum'];
        $phk->sesudah = $request['sesudah'];
        $phk->status_data = 'Belum Dikonfirmasi';
        try{
            $success = $phk->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'phk' => [$phk],
                'message' => 'Tambah data berhasil.'
            ];   
        }
        catch(\Illuminate\Database\QueryException $e){
            $status = 500;
            $response = [
                'status' => 'Error',
                'phk' => [],
                'message' => $e
            ];
        }
        return response()->json($response,$status);
    }

    public function edit(Request $request, $id)
    {
        $phk = PHK::find($id);

        if($phk==NULL){
            $status=404;
            $response = [
                'status' => 'Error',
                'phk' => [],
                'message' => 'Data Tidak Ditemukan'
            ];
        }
        else{
            $phk->no_kk = $request['no_kk'];
            $phk->nik = $request['nik'];
            $phk->sebelum = $request['sebelum'];
            $phk->sesudah = $request['sesudah'];
            
            try{
                $success = $phk->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'phk' => [$phk],
                    'message' => 'Edit data berhasil.'
                ];  
            }
            catch(\Illuminate\Database\QueryException $e){
                $status = 500;
                $response = [
                    'status' => 'Error',
                    'phk' => [],
                    'message' => $e
                ];
            }
        }
        return response()->json($response,$status); 
    }

    public function konfirmasi($id)
    {
        $phk = PHK::find($id);

        if($phk==NULL){
            $status=404;
            $response = [
                'status' => 'Error',
                'phk' => [],
                'message' => 'Data Tidak Ditemukan'
            ];
        }
        else{
            $phk->status_data = 'Terkonfirmasi';
            
            try{
                $success = $phk->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'phk' => [$phk],
                    'message' => 'Konfirmasi data berhasil.'
                ];  
            }
            catch(\Illuminate\Database\QueryException $e){
                $status = 500;
                $response = [
                    'status' => 'Error',
                    'phk' => [],
                    'message' => $e
                ];
            }
        }
        return response()->json($response,$status); 
    }

    public function hapus($id)
    {
        $phk = PHK::find($id);

        if($phk==NULL){
            $status=404;
            $response = [
                'status' => 'Error',
                'phk' => [],
                'message' => 'Data Tidak Ditemukan'
            ];
        }
        else
        {
            $phk->delete();
            $status=200;
            $response = [
                'status' => 'Success',
                'phk' => [$phk],
                'message' => 'Hapus data berhasil.'
            ];
        }
        return response()->json($response,$status); 
    }
}
