<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\ump;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Client;

class umpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postedgeump(Request $request)
    {
        try {
            $request->validate([
                'volumeorganik' => 'required',
                'volumenonorganik' => 'required',
                'volumeB3' => 'required',
                'volumetotaledge' => 'required',
            ]);

            $url = 'http://10.100.1.152:8000/api/ump';
            $volumeorganik = $request->volumeorganik;
            $volumenonorganik = $request->volumenonorganik;
            $volumeB3 = $request->volumeB3;
            $volumetotaledge = $request->volumetotaledge;

            $data = [
                'volumeorganik' => $volumeorganik,
                'volumenonorganik' => $volumenonorganik,
                'volumeB3' => $volumeB3,
                'volumetotaledge' => $volumetotaledge,
            ];

            $client = new Client();
            $response = $client->post($url, [
                'timeout' => 4,
                'form_params' => $data
            ]);
            $data = ump::create([
                'volumeorganik' => $request -> volumeorganik,
                'volumenonorganik' => $request -> volumenonorganik,
                'volumeB3' => $request -> volumeB3,
                'volumetotaledge' => $request -> volumetotaledge,
                // 'status' => 'pending'
            ]);
            // ... (kode program lainnya)
        } catch (Exception $e) {
            // Ambil id_sensor dari request
            $id_sensor = $request->id_sensor;

            $data = ump::create([
                'volumeorganik' => $request -> volumeorganik,
                'volumenonorganik' => $request -> volumenonorganik,
                'volumeB3' => $request -> volumeB3,
                'volumetotaledge' => $request -> volumetotaledge,
                // 'status' => 'pending'
            ]);

            return response()->json([
                'message' => 'Error occurred while sending data to cloud',
                'error' => $e->getMessage(),
                'data' => $data
            ], 500);
        }
    }
    public function index()
    {
        //
        $data = ump::latest()->first();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
