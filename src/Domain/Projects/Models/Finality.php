<?php

namespace Domain\Projects\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
use Domain\Projects\Models\Project;
use Illuminate\Database\Eloquent\Model;

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

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
