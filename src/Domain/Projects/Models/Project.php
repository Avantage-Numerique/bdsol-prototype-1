<?php

namespace Domain\Projects\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\ContactMethods\Models\Traits\ContactableTrait;
use Domain\Identifiants\Models\Traits\IdentifiableTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Domain\Projects\Models\Finality;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use CrudTrait;
    use SluggableTrait;
    use ContactableTrait;
    use IdentifiableTrait;

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
        'all_contact_methods',  //polymorphic relation table.
        'all_contact_methods_raw',  //polymorphic relation table.
        'all_identifiants',  //polymorphic relation table.
        'all_identifiants_raw',  //polymorphic relation table.
        'updated_at',
        'created_at',
        'finality_id',
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
        'all_identifiants_raw'
    ];


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function finality() {
        return $this->belongsTo(Finality::class);
    }

}
