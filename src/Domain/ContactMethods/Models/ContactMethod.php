<?php

namespace Domain\ContactMethods\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Persons\Models\Person;
use Illuminate\Database\Eloquent\Model;

use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ContactMethod extends Model
{

    //  ##  Traits    ##  //

    use CrudTrait;
    use SluggableTrait;


    //  ##  GLOBAL VARIABLES    ##  //

    protected $table = 'contact_methods';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    //  ##  Relations   ##  //

    //public function contactable() {
    //    return $this->morphTo();
    //}


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
            'model_has_contact_methods',
            'contact_method_id',
            'model_id'
        )->withPivot('method_value');
    }

    /**
     * Link contact_methods to organisations with model_has_contact_methods table.
     * no params
     * @return BelongsToMany the n:n polymorphic relation
     */
    public function organisations(): BelongsToMany
    {
        return $this->morphedByMany(
            'Domain\Organisations\Models\Organisation',
            'model',
            'model_has_contact_methods',
            'contact_method_id',
            'model_id'
        )->withPivot('method_value');
    }



}
