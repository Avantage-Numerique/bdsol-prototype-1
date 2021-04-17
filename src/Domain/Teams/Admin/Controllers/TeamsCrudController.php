<?php

namespace Domain\Teams\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

/**
 * TeamCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class TeamsCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\Teams\Models\Team::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/equipes');
        $this->crud->setEntityNameStrings('team', 'teams');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
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
