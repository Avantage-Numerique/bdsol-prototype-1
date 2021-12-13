<?php

namespace Domain\TimeLapse\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domain\Uri\Models\Traits\SluggableTrait;
//use Domain\Projects\Models\Project;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLapse extends Model
{
    use HasFactory;
    use CrudTrait;
/*show
    use SluggableTrait;
*/
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'project_time_lapse';

    protected $guarded = ['id'];

    protected $fillable = [
        'time_lapse'
    ];


    // Avoid Eloquent to manage and expect the created_at and updated_at columns
    public $timestamps = false;

    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    
    //Relation to link this model to project 
    //Doesn't seem to be necessay for now 
    
    public function projects()
    {
        return $this->hasMany('Domain\Projects\Models\Project', 'time_lapse_id');
    }


    

}
