<?php

namespace Domain\ContactMethods\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ContactMethod extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contact_methods';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /**
     * FUNTIONS
     */


    //  ##  Relations   ##  //
    /*public function persons() {
        $this->morphedByMany('Domain\Persons\Models\Person', 'contactable');
    }*/

    public function contactable() {
        return $this->morphTo();
    }


}
