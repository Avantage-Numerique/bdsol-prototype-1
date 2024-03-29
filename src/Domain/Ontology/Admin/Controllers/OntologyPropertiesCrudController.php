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
class OntologyPropertiesCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\Ontology\Models\OntologyProperty::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/ontology-properties');
        $this->crud->setEntityNameStrings('Propriété des classes de l\'ontologie', 'Propriétés des classes  de l\'ontologie');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->setFromDb(); // columns
    }

    protected function _addFields($state='all')
    {
        $tabs_principal = 'Principale';

        $this->crud->addField([
            'name' => 'title',
            'label' => 'Titre',
            'type' => 'text',
            'tab' => $tabs_principal,
        ]);

        $this->crud->addField([
            'name' => 'intro',
            'label' => 'Introduction',
            'type' => 'wysiwyg',
            'tab' => $tabs_principal,
        ]);

        $this->crud->addField([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'wysiwyg',
            'tab' => $tabs_principal,
        ]);
    }
}
