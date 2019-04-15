<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bug extends Model
{
    protected $table = "bug";
    protected $fillable = ['b_cat_id','bug_name','bug_nor','bug_about','bug_impact','bug_produce','created_at','bug_poc','bug_poc_exten','report'];
    const UPDATED_AT = null;
}
