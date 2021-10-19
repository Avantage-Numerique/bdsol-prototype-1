<?php

namespace Domain\Ontology\Admin\Controllers;

use Domain\Admin\Controllers\BaseCrudController;

/**
 * OntologyClassesCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class OntologyClassesCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\Ontology\Models\OntologyClass::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/ontology-classes');
        $this->crud->setEntityNameStrings('Classe de l\'ontologie', 'Classes de l\'ontologie');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->setFromDb(); // columns
    }

    protected function _addFields($state='all')
    {
        //$this->crud->setFromDb(); // fields
        $tabs_principal = 'Principale';
        $tab_properties = 'Properties';
        $tab_sub_classes = 'Classes liées';

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


        $this->crud->addField([
            'name' => 'properties',
            'label' => 'Properties',
            'type' => 'text',
            'tab' => $tab_properties,
        ]);

        $this->crud->addField([
            'name' => 'subclasses',
            'label' => 'Sous-classes',
            'type' => 'text',
            'tab' => $tab_sub_classes,
        ]);
    }
}
