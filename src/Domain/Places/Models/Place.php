<?php

namespace Domain\Places\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\ContactMethods\Models\Traits\ContactableTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use CrudTrait;
    use SluggableTrait;
    use ContactableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'places';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'slug',
        'name',
        'address',
        'description',
        'logo',
        'header_image',
        'all_contact_methods',  //polymorphic relation table.
        'all_contact_methods_raw',  //polymorphic relation table.
        'updated_at',
        'created_at'
    ];
    // protected $hidden = [];
    // protected $dates = [];


}
