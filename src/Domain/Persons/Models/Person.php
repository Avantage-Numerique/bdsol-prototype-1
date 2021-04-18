<?php

namespace Domain\Persons\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\ContactMethods\Traits\ContactableTrait;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use CrudTrait;
    //use ContactableTrait;

    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'firstname',
        'lastname',
        'nickname',
        'address',
        'description',
        'logo',
        'avatar',
        'header_image',
        'updated_at',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];



    //  ##  Relations   ##  //


    public function contact_methods() {
        $this->morphMany('Domain\ContactMethods\Models\ContactMethod', 'contactable');
    }



    //  ##  MUTATORS    ##  //


    public function getNameAttribute() {
        return $this->firstname." ".$this->lastname;
    }

}
