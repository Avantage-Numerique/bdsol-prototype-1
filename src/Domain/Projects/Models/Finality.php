<?php

namespace Domain\Projects\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Domain\Projects\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Finality extends Model
{
    use CrudTrait;
    use SluggableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'finalities';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */



    /**
     * Link identifiants to persons with model_has_identifiants table.
     * no params
     * @return BelongsToMany the n:n polymorphic relation
     */
    public function projects(): BelongsToMany
    {
        return $this->morphedByMany(
            'Domain\Projects\Models\Project',
            'model',
            'model_has_finalities',
            'finality_id',
            'model_id'
        )->withPivot('model_value');
    }
}
