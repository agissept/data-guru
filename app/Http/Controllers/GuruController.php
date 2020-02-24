<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Guru;
use App\Pangkat;
use App\Jabatan;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guru/guru');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listSekolah = Sekolah::all();
        $listPangkat = Pangkat::all();
        $listJabatan = Jabatan::all();
        return view('guru/tambah_guru', [ 'listSekolah' => $listSekolah ,'listPangkat' => $listPangkat, 'listJabatan' => $listJabatan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guru = new Guru;
        $guru->id_sekolah = $request->id_sekolah;
        $guru->nip = $request->nip;
        $guru->nuptk = $request->nuptk;
        $guru->nama = $request->nama;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->pangkat = $request->pangkat;
        $guru->tmt_pangkat_terakhir = $request->tmt_pangkat_terakhir;
        $guru->kgb = $request->kgb;
        $guru->id_jabatan = $request->jabatan;
        $guru->save();
        return redirect()->route('guru.create')->with(['success' => $request->nama.' Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::find($id);
        if($guru == null){
            abort(404);
        }
        return view('guru/detail_guru', ['guru' => $guru]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::find($id);
        if($guru == null){
            abort(404);
        }
        $listSekolah = Sekolah::all();
        $listPangkat = Pangkat::all();
        $listJabatan = Jabatan::all();
       
        return view('guru\edit_guru', ['guru' => $guru, 'listSekolah' => $listSekolah ,'listPangkat' => $listPangkat, 'listJabatan' => $listJabatan]);
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
        $guru = Guru::find($id);
        if($guru == null){
            abort(404);
        }
        $guru->id_sekolah = $request->id_sekolah;
        $guru->nip = $request->nip;
        $guru->nuptk = $request->nuptk;
        $guru->nama = $request->nama;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->id_pangkat = $request->pangkat;
        $guru->tmt_pangkat_terakhir = $request->tmt_pangkat_terakhir;
        $guru->kgb = $request->kgb;
        $guru->id_jabatan = $request->jabatan;
        $guru->save();

        return redirect()->route('guru.index')->with(['success' => $guru->nama.' Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::find($id);
        if($guru == null){
            abort(404);
        }
    
        $guru->delete();
        return redirect()->route('guru.index')->with(['success' => $guru->nama.' Berhasil Dihapus']);
    }

    public function search(Request $request, $jenjang = null)
    {
            $listGuru = Guru::where('nip', 'like', '%'.$request->kata_kunci.'%')
            ->orWhere('nuptk', 'like', '%'.$request->kata_kunci.'%')
            ->orWhere('nama', 'like', '%'.$request->kata_kunci.'%')
            ->get();
        return view('guru\hasil_pencarian_guru', ['listGuru' => $listGuru]);
    }

    public function showJenjang()
    {
        $jenjang = request()->segment(count(request()->segments()));
        $listGuru = Guru::whereHas('sekolah', function($query) use ($jenjang){
            $query->where('jenjang', $jenjang);
        })->get();
        
        return view('guru\hasil_pencarian_guru', ['listGuru' => $listGuru]);
    }
}
