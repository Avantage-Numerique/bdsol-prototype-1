<?php

namespace Domain\TimeLapse\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

use App\Http\Requests\TimeLapseRequest;


/**
 * ContactMethodCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
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

    /*
    protected function _addColumns($state='all')
    {
        //$this->crud->setFromDb(); // columns
    }
    */

    /*
    protected function _addFields($state='all')
    {
        $this->crud->setFromDb(); // fields

        
        // Fields can be defined using the fluent syntax or array syntax:
        // - CRUD::field('price')->type('number');
        // - CRUD::addField(['name' => 'price', 'type' => 'number']));
         
    }
    */

    public function setupListOperation()
    {
        $this->crud->setColumns(['time_lapse']);
    }

    public function setupCreateOperation()
    {
        $this->crud->setValidation(TimeLapseRequest::class);

        $this->crud->addField([
            'name' => 'time_lapse',
            'type' => 'text',
            'label' => "Échéance"
        ]);

    }
}
