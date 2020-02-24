<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function jabatan(){
        return $this->belongsTo('App\Jabatan', 'id_jabatan', 'id');
    }

    public function pangkat(){
        return $this->belongsTo('App\Pangkat', 'id_pangkat', 'id');
    }

    public function sekolah()
    {
        return $this->belongsTo('App\sekolah', 'id_sekolah', 'id');
    }
}

