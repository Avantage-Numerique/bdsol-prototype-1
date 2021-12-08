<?php

namespace Domain\Organisations\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Identifiants\Models\Traits\IdentifiableTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Domain\ContactMethods\Models\Traits\ContactableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organisation extends Model
{
    use CrudTrait;
    use ContactableTrait;
    use SluggableTrait;
    use IdentifiableTrait;

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
        'all_identifiants',  //polymorphic relation table.
        'all_identifiants_raw',  //polymorphic relation table.
        'updated_at',
        'created_at'
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


    //  Relations


    /**
     * Link identifiants to persons with model_has_identifiants table.
     * no params
     * @return BelongsToMany the n:n polymorphic relation
     */
    public function projects()
    {
        return $this->morphedByMany(
            'Domain\Projects\Models\Project',
            'model',
            'model_has_organisations',
            'organisation_id',
            'model_id'
        )->withPivot('model_value');
    }
}
