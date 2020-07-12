<?php

namespace App\Http\Controllers;

use App\Miskin;
use Illuminate\Http\Request;

class MiskinController extends Controller
{
    public function index()
    {
        $miskin = Miskin::get();
        $response = [
            'status' => 'Success',
            'message' => $miskin
        ];
        return response()->json($response,200);
    }

    public function rekap()
    {
        $total = Miskin::count();
        $konfirmasi = Miskin::where('status_data', 'Terkonfirmasi')->count();
        $belumkonfirmasi = Miskin::where('status_data', 'Belum Dikonfirmasi')->count();
        $rekap = ['total' => $total, 'konfirmasi' => $konfirmasi, 'belumkonfirmasi' => $belumkonfirmasi];
        $response = [
            'status' => 'Success',
            'message' => $rekap
        ];
        return response()->json($response,200);
    }

    public function tambah(Request $request)
    {
        $miskin = new Miskin;
        $miskin->no_kk = $request['no_kk'];
        $miskin->jml_keluarga = $request['jml_keluarga'];
        $miskin->penghasilan = $request['penghasilan'];
        $miskin->status_data = 'Belum Dikonfirmasi';
        try{
            $success = $miskin->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'miskin' => [$miskin],
                'message' => 'Tambah data berhasil.'
            ];   
        }
        catch(\Illuminate\Database\QueryException $e){
            $status = 500;
            $response = [
                'status' => 'Error',
                'miskin' => [],
                'message' => $e
            ];
        }
        return response()->json($response,$status);
    }

    public function edit(Request $request, $id)
    {
        $miskin = Miskin::find($id);

        if($miskin==NULL){
            $status=404;
            $response = [
                'status' => 'Error',
                'miskin' => [],
                'message' => 'Data Tidak Ditemukan'
            ];
        }
        else{
            $miskin->no_kk = $request['no_kk'];
            $miskin->jml_keluarga = $request['jml_keluarga'];
            $miskin->penghasilan = $request['penghasilan'];
            
            try{
                $success = $miskin->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'miskin' => [$miskin],
                    'message' => 'Edit data berhasil.'
                ];  
            }
            catch(\Illuminate\Database\QueryException $e){
                $status = 500;
                $response = [
                    'status' => 'Error',
                    'miskin' => [],
                    'message' => $e
                ];
            }
        }
        return response()->json($response,$status); 
    }

    public function konfirmasi($id)
    {
        $miskin = Miskin::find($id);

        if($miskin==NULL){
            $status=404;
            $response = [
                'status' => 'Error',
                'miskin' => [],
                'message' => 'Data Tidak Ditemukan'
            ];
        }
        else{
            $miskin->status_data = 'Terkonfirmasi';
            
            try{
                $success = $miskin->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'miskin' => [$miskin],
                    'message' => 'Konfirmasi data berhasil.'
                ];  
            }
            catch(\Illuminate\Database\QueryException $e){
                $status = 500;
                $response = [
                    'status' => 'Error',
                    'miskin' => [],
                    'message' => $e
                ];
            }
        }
        return response()->json($response,$status); 
    }

    public function hapus($id)
    {
        $miskin = Miskin::find($id);

        if($miskin==NULL){
            $status=404;
            $response = [
                'status' => 'Error',
                'miskin' => [],
                'message' => 'Data Tidak Ditemukan'
            ];
        }
        else
        {
            $miskin->delete();
            $status=200;
            $response = [
                'status' => 'Success',
                'miskin' => [$miskin],
                'message' => 'Hapus data berhasil.'
            ];
        }
        return response()->json($response,$status); 
    }
}
