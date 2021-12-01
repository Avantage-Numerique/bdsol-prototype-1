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
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Titre',
            'type' => 'text'
        ]);
        $this->crud->addColumn([
            'name' => 'slug',
            'label' => 'URI',
            'type' => 'text'
        ]);

        $this->add_properties_columns();
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
            'name' => 'subclasses',
            'label' => 'Sous-classes',
            'type' => 'text',
            'tab' => $tab_sub_classes,
        ]);

        $this->add_properties_fields();
    }



    public function add_properties_fields($label='Propriétés de la classes', $tab='Properties')
    {
        if( isset($this->crud))
        {
            $this->crud->addField([   // repeatable
                'name'  => 'all_properties',
                'label' => $label,
                'type'  => 'repeatable',
                'fields' => [
                    [
                        'name'    => 'id',
                        'type'    => 'hidden'
                    ],[
                        'name'    => 'title',
                        'type'    => 'text',
                        'label'   => 'Label de la propriété',
                        'wrapper' => ['class' => 'form-group col-md-8'],
                    ],[
                        'label'     => "Description courte de la propriété",
                        'type'      => 'textarea',
                        'name'      => 'intro', // the method that defines the relationship in your Model
                    ]
                ],
                // optional
                'new_item_label' => 'Ajouter une propriété',
                'init_rows' => 0,
                'min_rows' => 0,
                'max_rows' => 0,
                'tab' => $tab,
            ]);   //  ## Données de contact.
        }
    }


    public function add_properties_columns()
    {
        if( isset($this->crud))
        {
            $this->crud->addColumn([
                'name' => 'properties',
                'type' => 'model_function',
                'label' => 'Propriétés',
                'function_name' => 'columnProperties',
                'escaped' => false,
                'limit' => 100,//model_function type limit at 40 if not specified. We know html could be big sometime.
            ]);
        }
    }
}
