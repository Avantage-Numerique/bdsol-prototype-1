<?php

namespace Domain\Ontology\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Ontology\Models\Traits\AvailableToApi;
use Illuminate\Database\Eloquent\Model;
use Mamarmite\Database\Traits\SecondaryDBTrait;

class OntologySource extends Model
{
    use CrudTrait;
    use AvailableToApi;
    use SecondaryDBTrait;

    protected $connection = 'ontology';

    protected $table = 'sources';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        "title",
        "slug",
        "intro",
        "value_expected",
        "url",
        "url_parent",
    ];
    // protected $hidden = [];
    // protected $dates = [];a


    // relations

    /*public function classes() {
        return $this->morphedByMany(
            'Domain\Ontology\Models\OntologyClass',
            'model',
            'model_has_properties',
            'property_id',
            'model_id'
        )->withPivot('model_value');
    }*/

}
