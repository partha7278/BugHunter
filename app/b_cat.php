<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class b_cat extends Model
{
    protected $table = "b_cat";
    protected $fillable =['b_cat_name'];
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function bugs(){
        return $this->hasMany('App\bug');
    }

}
