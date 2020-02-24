<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Guru;
use App\Jabatan;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listSekolah = Sekolah::all();
        return view('sekolah/sekolah', ['listSekolah' => $listSekolah]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sekolah/tambah_sekolah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sekolah = new Sekolah();
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->kota = $request->kota;
        $sekolah->kecamatan = $request->kecamatan;
        $sekolah->kelurahan = $request->kelurahan;
        $sekolah->alamat = $request->alamat;
        $sekolah->koordinat = $request->koordinat;
        $sekolah->jenjang = $request->jenjang;
        $sekolah->save();
        return redirect()->route('sekolah.create')->with(['success' => $request->nama_sekolah.' Berhasil Ditambahkan']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sekolah = Sekolah::find($id);
        $listGuru = Guru::where('id_sekolah', $id)->get();
        $kepalaSekolah = Guru::where('id_jabatan', 4)->where('id_sekolah', $id)->first();
        if($kepalaSekolah != null){
            $kepalaSekolah = $kepalaSekolah->nama;
        }
        $kepalaTU = Guru::where('id_jabatan', 5)->where('id_sekolah', $id)->first();
        if($kepalaTU != null){
            $kepalaTU = $kepalaTU->nama;
        }
        if($sekolah == null){
            abort(404);
        }
        return view('sekolah\detail_sekolah', [
            'sekolah' => $sekolah, 
            'listGuru' => $listGuru, 
            'kepalaSekolah' => $kepalaSekolah,
            'kepalaTU' => $kepalaTU,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $sekolah = Sekolah::find($id);
        if($sekolah == null){
            abort(404);
        }
        return view('sekolah\edit_sekolah', ['sekolah' => $sekolah]);
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
        Sekolah::find($id)->delete();
        return redirect()->route('sekolah.index');
    }

    public function search($jenjang){
    
    }

    public function showJenjang(){
        $jenjang = request()->segment(count(request()->segments()));
        $listSekolah = Sekolah::where('jenjang', $jenjang)->get();
        return view('sekolah/sekolah', ['listSekolah' => $listSekolah]);
    }
}

