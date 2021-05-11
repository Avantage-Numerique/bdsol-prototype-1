<?php

namespace Domain\Places\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Domain\Admin\Controllers\BaseCrudController;
use Domain\ContactMethods\Admin\Controllers\Traits\ContactMethodsCrudTrait;

/**
 * PlaceCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class PlacesCrudController extends BaseCrudController
{
    use HasUploadFields;
    use ContactMethodsCrudTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        parent::setup();
        $this->crud->setModel(\Domain\Places\Models\Place::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/lieux');
        $this->crud->setEntityNameStrings(__('places.place'), __('places.places'));
    }

    protected function _addColumns($state='all')
    {
        $this->crud->addColumn([
            'name' => 'logo',
            'type' => 'image',
            'label' => __('places.avatar')
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => __('places.name')
        ]);

        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => __('places.name')
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

        $this->crud->addColumn([
            'name' => 'address',
            'type'=> 'address',
            'label' => __('places.address'),
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
            'name' => 'name',
            'type' => 'text',
            'label' => __('places.name'),
            'wrapper'   => [
                'class'      => 'form-group col-md-12'
            ],
            'tab' => $this->tab_info,
        ]);

        /*
         * Algolia is killing Places. Please note that Algolia Places will stop working in May 2022
         */
        $this->crud->addField([
            'name' => 'address',
            'type'=> 'address',
            'label' => __('places.address'),
            'tab' => $this->tab_info,
            // optional
            'store_as_json' => true
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'wysiwyg',
            'label' => __('places.description'),
            'tab' => $this->tab_info,
        ]);


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

        //  ##  TAB : MEDIAS

        $this->crud->addField([
            'name' => 'logo',
            'type' => 'image',
            'label' => __('places.logo'),
            'tab' => $this->tab_medias,
        ]);

        $this->crud->addField([
            'name' => 'header_image',
            'type' => 'image',
            'label' => __('places.header-image'),
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
}
