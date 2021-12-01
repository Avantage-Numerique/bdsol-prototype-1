<?php

namespace Domain\Projects\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\ContactMethods\Models\Traits\ContactableTrait;
use Domain\Identifiants\Models\Traits\IdentifiableTrait;
use Domain\Projects\Models\Traits\FinalitableTrait;
use Domain\Uri\Models\Traits\SluggableTrait;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use CrudTrait;
    use SluggableTrait;
    use ContactableTrait;
    use IdentifiableTrait;
    use FinalitableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'projects';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'slug',
        'name',
        'description',
        'logo',
        'header_image',
        'all_contact_methods',
        'all_contact_methods_raw',
        'all_identifiants',
        'all_identifiants_raw',
        'all_finalities',
        'all_finalities_raw',
        'updated_at',
        'created_at',
        'starting_date',
        'ending_date',
        //'finality_id',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'all_contact_methods_raw',
        'all_identifiants_raw',
        'all_finalities_raw'
    ];


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
}
