<?php

namespace Domain\Persons\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

// VALIDATION

/**
 * PersonCrudController
 * Gestion des entités personnes
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class PersonCrudController extends BaseCrudController
{

    public function setup()
    {
        $this->crud->setModel('\Domain\Persons\Models\Person');
        $this->crud->setEntityNameStrings(trans('persons.person'), trans('persons.persons'));
        $this->crud->setRoute(backpack_url('personnes'));
    }

    /*public function store()
    {
        dd($this->crud->getRequest()->request);
    }*/


    protected function _addColumns($state='all') {

        $this->crud->addColumn([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('persons.avatar')
        ]);

        $this->crud->addColumn([
            'name' => 'firstname',
            'type' => 'text',
            'label' => __('persons.firstname')
        ]);
        $this->crud->addColumn([
            'name' => 'lastname',
            'type' => 'text',
            'label' => __('persons.lastname')
        ]);
        $this->crud->addColumn([
            'name' => 'nickname',
            'type' => 'text',
            'label' => __('persons.nickname')
        ]);

        $this->crud->addColumn([
            'name' => 'slug',
            'type' => 'text',
            'label' => __('admin.slug')
        ]);
    }

    protected function _addFields($state='all')
    {
        /*'slug',
        'firstname',
        'lastname',
        'nickname',
        'description',
        'logo',
        'avatar',
        'header_image',*/
        $tab_info = __('admin.tab-info');
        $tab_medias = __('admin.tab-medias');
        $tab_contact = __('admin.tab-contacts');
        $tab_parameters = __('admin.tab-parameters');

        //  ##  TAB : INFORMATION

        $this->crud->addField([
            'name' => 'firstname',
            'type' => 'text',
            'label' => __('persons.firstname'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $tab_info,
        ]);
        $this->crud->addField([
            'name' => 'lastname',
            'type' => 'text',
            'label' => __('persons.lastname'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $tab_info,
        ]);
        $this->crud->addField([
            'name' => 'nickname',
            'type' => 'text',
            'label' => __('persons.nickname'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $tab_info,
        ]);

        /*$this->crud->addField([
            'label'     => 'Méthodes de contact',
            'type'      => 'select2',
            'name'      => 'contact_method_id',
            'entity'    => 'contact_methods',
            'attribute' => 'name',
            'model'     => 'Domain\ContactMethods\Models\ContactMethod',
            'pivot'     => true,
        ]);*/

        /*$this->crud->addField([
            'label' => 'Méthode de contact',
            'type' => 'select2_multiple',
            'name' => 'contactable',
            'entity' => 'contact_methods',
            'model' => 'Domain\ContactMethods\Models\ContactMethod',
            'attribute' => 'name',
            'morph' => true,
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);*/


        //  ## Données de contact.

        /*$this->crud->addField([   // repeatable
            'name'  => 'contact_methods',
            'label' => 'Méthode pour entrer en contact',
            'type'  => 'repeatable',
            'fields' => [
                [
                    'name' => 'contact_method_user',
                    'type' => 'text',
                    'label' => 'Nom d\'utilisateur',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],[
                    'name' => 'contactable',
                    'type' => 'select2',
                    'label' => 'Méthode de contact',
                    'entity' => 'contactable',
                    'model' => 'Domain\ContactMethods\Models\ContactMethod',
                    'attribute' => 'name',
                    'pivot' => true,
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ]
            ],
            // optional
            'new_item_label' => 'Ajouter une méthode',
            'init_rows' => 1,
            'min_rows' => 0,
            'max_rows' => -1,
            'tab' => $tab_contact,
        ]);*/

        /*
         * Algolia is killing Places. Please note that Algolia Places will stop working in May 2022
         */
        $this->crud->addField([
            'name' => 'address',
            'type'=> 'address',
            'label' => __('persons.address'),
            'tab' => $tab_info,
            // optional
            'store_as_json' => true
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'wysiwyg',
            'label' => __('persons.description'),
            'tab' => $tab_info,
        ]);

        //  ##  TAB : MEDIAS

        $this->crud->addField([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('persons.avatar'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $tab_medias,
        ]);
        $this->crud->addField([
            'name' => 'logo',
            'type' => 'image',
            'label' => __('persons.logo'),
            'tab' => $tab_medias,
        ]);

        $this->crud->addField([
            'name' => 'header_image',
            'type' => 'image',
            'label' => __('persons.header-image'),
            'tab' => $tab_medias,
        ]);


        //  ##  TAB : PARAMÈTRES

        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => __('admin.slug'),
            'hint' => __('admin.slug-hint'),
            'tab' => $tab_parameters,
        ]);
    }
}
