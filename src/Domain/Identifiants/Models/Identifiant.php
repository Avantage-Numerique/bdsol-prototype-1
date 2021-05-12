<?php

namespace Domain\Identifiants\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Identifiant extends Model
{
    use CrudTrait;
    use SluggableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'identifiants';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'slug',
        'base_url',
        'connection_method',
        'is_syncable'
    ];


    /**
     * Link contact_methods to persons with model_has_contact_methods table.
     * no params
     * @return BelongsToMany the n:n polymorphic relation
     */
    public function persons(): BelongsToMany
    {
        return $this->morphedByMany(
            'Domain\Persons\Models\Person',
            'model',
            'model_has_identifiants',
            'identifiant_id',
            'model_id'
        )->withPivot('model_value');
    }
}
