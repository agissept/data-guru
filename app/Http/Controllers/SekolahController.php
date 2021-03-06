<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Guru;
use App\Jabatan;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        if($sekolah == null){
            abort(404);
        }
        $listGuru = Guru::where('id_sekolah', $id)->get();
        $kepalaSekolah = Guru::where('id_jabatan', 4)->where('id_sekolah', $id)->first();
        if($kepalaSekolah != null){
            $kepalaSekolah = $kepalaSekolah->nama;
        }
        $kepalaTU = Guru::where('id_jabatan', 5)->where('id_sekolah', $id)->first();
        if($kepalaTU != null){
            $kepalaTU = $kepalaTU->nama;
        }
        $jumlahGuru =  Guru::where('id_jabatan', 1)->where('id_sekolah', $id)->count() + 1;
        $jumlahTU =  Guru::where('id_jabatan', 2)->where('id_sekolah', $id)->count() + 1;

        return view('sekolah\detail_sekolah', [
            'sekolah' => $sekolah, 
            'listGuru' => $listGuru, 
            'kepalaSekolah' => $kepalaSekolah,
            'kepalaTU' => $kepalaTU,
            'jumlahGuru' => $jumlahGuru,
            'jumlahTU' => $jumlahTU
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
        $sekolah = Sekolah::find($id);
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->kota = $request->kota;
        $sekolah->kecamatan = $request->kecamatan;
        $sekolah->kelurahan = $request->kelurahan;
        $sekolah->alamat = $request->alamat;
        $sekolah->koordinat = $request->koordinat;
        $sekolah->jenjang = $request->jenjang;
        $sekolah->save();
        return redirect()->route('sekolah.show', $id)->with(['success' => $request->nama_sekolah.' Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = Sekolah::find($id);
        if($sekolah == null){
            abort(404);
        }
        $nama_sekolah = $sekolah->nama_sekolah;
        $jenjang = $sekolah->jenjang;
        $kota = ucfirst(strtolower($sekolah->kota));
        $sekolah->delete();
        return redirect('sekolah/'.$jenjang.'?kota='.$kota)->with(['success' => $nama_sekolah.' Berhasil Dihapus']);
    }

    public function showJenjang(){
        $kota = strtoupper($_GET['kota']);
        $jenjang = request()->segment(count(request()->segments()));
        $listSekolah = Sekolah::where('jenjang', $jenjang);

        if($kota != ''){
            $listSekolah->where('kota', $kota);

        };
        return view('sekolah/sekolah', ['listSekolah' => $listSekolah->get()]);
    }
}

