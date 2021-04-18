<?php

namespace Domain\ContactMethods\Models;

use Illuminate\Database\Eloquent\Model;

class Contactable extends Model
{
    protected $table = 'contactable';
    public $timestamps = true;
    protected $fillable = ['contact_method_user'];
    // protected $primaryKey = '';
    //protected $guarded = [];
    // protected $hidden = [];
    // protected $dates = [];

}
