<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = 'pangkat';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function guru()
    {
        return $this->hasMany('App\Guru', 'id', 'id_pangkat');
    }
}
