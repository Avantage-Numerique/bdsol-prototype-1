<?php

namespace Domain\Persons\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Person extends Model
{
    use CrudTrait;

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


    //  ##  MUTATORS    ##

    public function getNameAttribute() {
        return $this->firstname." ".$this->lastname;
    }

}
