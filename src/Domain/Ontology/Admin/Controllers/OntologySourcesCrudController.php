<?php

namespace Domain\Ontology\Admin\Controllers;

use Domain\Admin\Controllers\BaseCrudController;

/**
 * OntologyPropertiesCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class OntologySourcesCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\Ontology\Models\OntologySource::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/ontology-properties');
        $this->crud->setEntityNameStrings('Propriété des classes de l\'ontologie', 'Propriétés des classes  de l\'ontologie');
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
