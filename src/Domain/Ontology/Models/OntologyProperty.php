<?php

namespace Domain\Ontology\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Ontology\Models\Traits\AvailableToApi;
use Illuminate\Database\Eloquent\Model;
use Mamarmite\Database\Traits\SecondaryDBTrait;

class OntologyProperty extends Model
{
    use CrudTrait;
    use AvailableToApi;
    use SecondaryDBTrait;

    protected $connection = 'ontology';

    protected $table = 'property';
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
    // protected $dates = [];

}
