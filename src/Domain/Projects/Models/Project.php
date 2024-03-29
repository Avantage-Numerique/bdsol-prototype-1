<?php

namespace Domain\Projects\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Admin\Models\Traits\AbstractPolymorphicTrait;
use Domain\ContactMethods\Models\Traits\ContactableTrait;
use Domain\Identifiants\Models\Traits\IdentifiableTrait;
use Domain\Organisations\Models\Traits\OrganisationableTrait;
use Domain\Projects\Models\Traits\FinalitableTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Domain\Persons\Models\Traits\PersonableTrait;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use CrudTrait;
    use SluggableTrait;


    use AbstractPolymorphicTrait;

    use ContactableTrait;
    use IdentifiableTrait;
    use FinalitableTrait;
    use PersonableTrait;
    use OrganisationableTrait;

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
        'time_lapse_id',
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

    //Relation to link the project model to the time lapse model : One to many
    public function timelapse()
    {   
        return $this->belongsTo('Domain\TimeLapse\Models\TimeLapse', 'time_lapse_id');
    }

}
