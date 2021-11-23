<?php

namespace Domain\Ontology\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Ontology\Models\Traits\AvailableToApi;
use Domain\Ontology\Models\Traits\PropertyableTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Mamarmite\Database\Traits\SecondaryDBTrait;

class OntologyClass extends Model
{
    use CrudTrait;
    use SluggableTrait;
    use SecondaryDBTrait;

    use PropertyableTrait;

    protected $connection = 'ontology';


    protected $slug_from = 'title';

    protected $table = 'classes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'slug',
        'intro',
        'description',
        'source',
        'all_properties'
    ];
    // protected $hidden = [];
    // protected $dates = [];


    //  Relation

}
