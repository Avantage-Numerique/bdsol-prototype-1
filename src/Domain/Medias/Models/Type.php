<?php

namespace Domain\Medias\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use CrudTrait;
    use SluggableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'media_types';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
}
