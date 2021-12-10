<?php

namespace Domain\TimeLapse\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

use App\Http\Requests\TimeLapseRequest;


/**
 *
 * @projet
 * @organisation <Avantage Numérique>
 * @author  <Vincent Poirier Ruel>
 * @license <https://opensource.org/licenses/MIT> MIT
 */

class TimeLapseCrudController extends BaseCrudController
{

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\TimeLapse\Models\TimeLapse::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/echeance');
        $this->crud->setEntityNameStrings('Échéance', 'Échéances');
    }

    public function setupListOperation()
    {
        $this->crud->setColumns(['time_lapse']);
    }

    //Create time lapse
    public function setupCreateOperation()
    {
        $this->crud->setValidation(TimeLapseRequest::class);

        $this->crud->addField([
            'name' => 'time_lapse',
            'type' => 'text',
            'label' => "Échéance",
    
        ]);
    }


    //Edit the existing time lapses
    public function setupUpdateOperation()
    {
        $this->crud->setValidation(TimeLapseRequest::class);

        $this->crud->addField([
            'name' => 'time_lapse',
            'type' => 'text',
            'label' => "Échéance",
        ]);
    }
}
