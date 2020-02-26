<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sekolah;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listSekolah = Sekolah::with('guru')->get()->groupBy('jenjang');
        $listJumlahGuru = DB::select('SELECT sekolah.jenjang, count(guru.id) as total_guru FROM sekolah inner join guru on sekolah.id = guru.id_sekolah GROUP by sekolah.jenjang');
        return view('home/home', ['listSekolah' => $listSekolah, 'listJumlahGuru' => $listJumlahGuru]);
    }

        public function adminHome()
    {
        return view('adminHome');
    }
}
