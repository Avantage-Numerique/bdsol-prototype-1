<?php

namespace Domain\Organisations\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Domain\ContactMethods\Models\Traits\ContactableTrait;

class Organisation extends Model
{
    use CrudTrait;
    use ContactableTrait;
    use SluggableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'organisations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'slug',
        'name',
        'legal_name',
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
