<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //protected $dateFormat = 'U';
    protected $fillable = [
        'fa_name',
        'en_name',
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'id'
    ];

    public function skills()
    {
        return $this->hasMany('App\Skill', 'category_uuid', 'uuid');
    }
}
