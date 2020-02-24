<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function guru()
    {
        return $this->hasMany('App\Guru', 'id_sekolah', 'id');
    }
}
