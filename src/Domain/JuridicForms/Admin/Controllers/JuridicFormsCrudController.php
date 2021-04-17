<?php

namespace Domain\JuridicForms\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

/**
 * JuridicFormCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class JuridicFormsCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\JuridicForms\Models\JuridicForm::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/formes-juridique');
        $this->crud->setEntityNameStrings('juridic_form', 'juridic_forms');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->setFromDb(); // columns
    }

    protected function _addFields($state='all')
    {
        $this->crud->setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }
}
