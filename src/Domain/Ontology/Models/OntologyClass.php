<?php

namespace Domain\Ontology\Models;

use Domain\Ontology\Traits\AvailableToApi;
use Illuminate\Database\Eloquent\Model;
use Mamarmite\Database\Traits\SecondaryDBTrait;

class OntologyClass extends Model
{
    use AvailableToApi;
    use SecondaryDBTrait;

    protected $secondary_connection = 'database.ontology';

    protected $table = 'classes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

}
