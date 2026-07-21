<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffreService extends Model
{
    protected $guarded = [];

    public static function getOne($id) {
        return self::where('id','=',$id)
                   ->where('status','=',true)
                   ->firstOrFail();
    }
}
