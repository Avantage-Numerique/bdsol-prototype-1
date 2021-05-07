<?php

namespace Domain\Organisations\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Domain\ContactMethods\Models\Traits\ContactableTrait;

class Organisation extends Model
{
    use CrudTrait;
    use ContactableTrait;

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
        'avatar',
        'header_image',
        'all_contact_methods',  //polymorphic relation table.
        'updated_at',
        'created_at'
    ];
    // protected $hidden = [];
    // protected $dates = [];

}
