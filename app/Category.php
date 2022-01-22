<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $fillable = [
        'id', 'name', 'tallysheet'
    ];

    public function checkForCategories()
    {
        if(DB::table('categories')->count('id') > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
