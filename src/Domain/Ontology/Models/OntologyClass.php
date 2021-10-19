<?php

namespace Domain\Ontology\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Ontology\Models\Traits\AvailableToApi;
use Illuminate\Database\Eloquent\Model;
use Mamarmite\Database\Traits\SecondaryDBTrait;

class OntologyClass extends Model
{
    use CrudTrait;
    use AvailableToApi;
    use SecondaryDBTrait;

    protected $connection = 'ontology';

    protected $table = 'classes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    //  Relation

    /*public function properties() {

    }*/

}
