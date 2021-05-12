<?php

namespace Domain\Persons\Admin\Controllers;

use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Domain\Admin\Controllers\BaseCrudController;
use Domain\Persons\Admin\Requests\PersonCrudRequest as StoreRequest;
use Domain\Persons\Admin\Requests\PersonCrudRequest as UpdateRequest;
use Domain\Persons\Models\Person;
use Domain\ContactMethods\Models\ContactMethod;
use Domain\ContactMethods\Admin\Controllers\Traits\ContactMethodsCrudTrait;
use Domain\Identifiants\Admin\Controllers\Traits\IdentifiantsCrudTrait;


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
    use HasUploadFields;
    use ContactMethodsCrudTrait;
    use IdentifiantsCrudTrait;

    public $contact_method_model;

    public function setup()
    {
        parent::setup();
        $this->contact_method_model = $contact_method_model = ContactMethod::class;

        $this->crud->setModel('\Domain\Persons\Models\Person');
        $this->crud->setEntityNameStrings(trans('persons.person'), trans('persons.persons'));
        $this->crud->setRoute(backpack_url('personnes'));
    }

    public function setupCreateOperation()
    {
        parent::setupCreateOperation();

        $this->crud->setValidation(StoreRequest::class);
    }

    public function setupUpdateOperation()
    {
        parent::setupUpdateOperation();

        $this->crud->setValidation(UpdateRequest::class);
    }

    protected function _addColumns($state='all') {

        $this->crud->addColumn([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('persons.avatar'),
            'prefix' => 'persons/avatars/',
            'disk'   => 'public',
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

        /**
         * From ContactMethodsCrudTrait
         */
        $this->add_contact_methods_columns();
        $this->add_identifiants_columns();

        $this->crud->addColumn([
            'name' => 'address',
            'type'=> 'address',
            'label' => __('persons.address'),
            // optional
            'fields' => [
                'name' => true,
                'administrative'=> true,
                'country' => false,
                'postcode' => false,
                'latlng' => true,
            ],
        ]);
    }

    protected function _addFields($state='all')
    {

        //  ##  TAB : INFORMATION

        $this->crud->addField([
            'name' => 'firstname',
            'type' => 'text',
            'label' => __('persons.firstname'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $this->tab_info,
        ]);
        $this->crud->addField([
            'name' => 'lastname',
            'type' => 'text',
            'label' => __('persons.lastname'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $this->tab_info,
        ]);
        $this->crud->addField([
            'name' => 'nickname',
            'type' => 'text',
            'label' => __('persons.nickname'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $this->tab_info,
        ]);


        //  ## Données de contact.

        $this->crud->addField([   // repeatable
            'name'  => 'all_contact_methods',
            'label' => 'Méthode pour entrer en contact',
            'type'  => 'repeatable',
            'fields' => [
                [
                    'name'    => 'method_value',
                    'type'    => 'text',
                    'label'   => 'Votre utilisateur',
                    'wrapper' => ['class' => 'form-group col-md-8'],
                ],[
                    'label'     => "Méthodes de contact",
                    'type'      => 'select2',
                    'name'      => 'contact_methods', // the method that defines the relationship in your Model

                    // optional
                    'entity'    => 'contact_methods', // the method that defines the relationship in your Model
                    'model'     => "Domain\ContactMethods\Models\ContactMethod", // foreign key model
                    'attribute' => 'name', // foreign key attribute that is shown to user
                    'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                    'select_all' => true, // show Select All and Clear buttons?
                    'tab' => $this->tab_info,
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ]
            ],
            // optional
            'new_item_label' => 'Ajouter une méthode de contact',
            'init_rows' => 0,
            'min_rows' => 0,
            'max_rows' => 0,
            'tab' => $this->tab_contact,
        ]);


        /*
         * Algolia is killing Places. Please note that Algolia Places will stop working in May 2022
         */
        $this->crud->addField([
            'name' => 'address',
            'type'=> 'address',
            'label' => __('persons.address'),
            'tab' => $this->tab_info,
            // optional
            'store_as_json' => true
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'wysiwyg',
            'label' => __('persons.description'),
            'tab' => $this->tab_info,
        ]);


        //  ##  TAB : MEDIAS

        $this->crud->addField([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('persons.avatar'),
            'upload' => true,
            'prefix' => 'persons/avatars/',
            'disk'   => 'public',
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $this->tab_medias,
        ]);
        /*$this->crud->addField([
            'name' => 'logo',
            'type' => 'image',
            'label' => __('persons.logo'),
            'tab' => $this->tab_medias,
        ]);*/

        $this->crud->addField([
            'name' => 'header_image',
            'type' => 'image',
            'label' => __('persons.header-image'),
            'tab' => $this->tab_medias,
        ]);


        //  ##  TAB : PARAMÈTRES

        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => __('admin.slug'),
            'hint' => __('admin.slug-hint'),
            'tab' => $this->tab_parameters,
        ]);
    }


    public function update()
    {
        return parent::update();
    }

    public function store()
    {
        return parent::store();
    }
}
