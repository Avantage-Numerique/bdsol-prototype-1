<?php

namespace Domain\Organisations\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

/**
 * OrganisationCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class OrganisationsCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\Organisations\Models\Organisation::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/organisations');
        $this->crud->setEntityNameStrings(__('organisations.organisation'), __('organisations.organisations'));
    }

    protected function _addColumns($state='all')
    {
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => __('organisations.avatar')
        ]);
        $this->crud->addColumn([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('organisations.avatar')
        ]);

        $this->crud->addColumn([
            'name' => 'slug',
            'type' => 'text',
            'label' => __('admin.slug')
        ]);
    }

    protected function _addFields($state='all')
    {

        $tab_info = __('admin.tab-info');
        $tab_medias = __('admin.tab-medias');
        $tab_parameters = __('admin.tab-parameters');

        //  ##  TAB : INFORMATION

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => __('organisations.name'),
            'wrapper'   => [
                'class'      => 'form-group col-md-6'
            ],
            'tab' => $tab_info,
        ]);
        $this->crud->addField([
            'name' => 'legal-name',
            'type' => 'text',
            'label' => __('organisations.legal-name'),
            'wrapper'   => [
                'class'      => 'form-group col-md-6'
            ],
            'tab' => $tab_info,
        ]);

        /*
         * Algolia is killing Places. Please note that Algolia Places will stop working in May 2022
         */
        $this->crud->addField([
            'name' => 'address',
            'type'=> 'address',
            'label' => __('organisations.address'),
            'tab' => $tab_info,
            // optional
            'store_as_json' => true
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'wysiwyg',
            'label' => __('organisations.description'),
            'tab' => $tab_info,
        ]);

        //  ##  TAB : MEDIAS

        $this->crud->addField([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('organisations.avatar'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $tab_medias,
        ]);
        $this->crud->addField([
            'name' => 'logo',
            'type' => 'image',
            'label' => __('organisations.logo'),
            'tab' => $tab_medias,
        ]);

        $this->crud->addField([
            'name' => 'header_image',
            'type' => 'image',
            'label' => __('organisations.header-image'),
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
