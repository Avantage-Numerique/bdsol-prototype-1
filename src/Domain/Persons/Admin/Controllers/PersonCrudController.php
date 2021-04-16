<?php

namespace Domain\Persons\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION

class PersonCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel('\Domain\Persons\Models\Person');
        $this->crud->setEntityNameStrings(trans('admin.person'), trans('admin.persons'));
        $this->crud->setRoute(backpack_url('personnes'));

    }

    public function setupListOperation()
    {

    }

    public function setupCreateOperation()
    {

    }

    public function setupUpdateOperation()
    {

    }

    private function addFields()
    {

    }
}
