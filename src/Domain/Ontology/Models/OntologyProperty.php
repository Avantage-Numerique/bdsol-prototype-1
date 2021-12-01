<?php

namespace Domain\Ontology\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Ontology\Models\Traits\AvailableToApi;
use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Mamarmite\Database\Traits\SecondaryDBTrait;

class OntologyProperty extends Model
{
    use CrudTrait;
    use SluggableTrait;
    use SecondaryDBTrait;

    protected $connection = 'ontology';


    protected $slug_from = 'title';

    protected $table = 'properties';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        "title",
        "slug",
        "intro",
        "description",
        "source",
    ];
    // protected $hidden = [];
    // protected $dates = [];a


    // relations

    public function classes() {
        return $this->morphedByMany(
            'Domain\Ontology\Models\OntologyClass',
            'model',
            'model_has_properties',
            'property_id',
            'model_id'
        )->withPivot('model_value');
    }

}
