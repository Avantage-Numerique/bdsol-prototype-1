<?php

namespace Domain\Events\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

/**
 * EventCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class EventsCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        parent::setup();
        $this->crud->setModel(\Domain\Events\Models\Event::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/evenements');
        $this->crud->setEntityNameStrings('événement', 'événements');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->addColumn([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('admin.avatar'),
        ]);

        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => __('admin.name'),
        ]);
        $this->crud->addColumn([
            'name' => 'slug',
            'type' => 'text',
            'label' => __('admin.slug'),
        ]);
    }

    protected function _addFields($state='all')
    {
        //  ##  TAB : INFORMATION

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => __('admin.name'),
            'wrapper'   => [
                'class'      => 'form-group col-md-6'
            ],
            'tab' => $this->tab_info,
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'wysiwyg',
            'label' => __('admin.description'),
            'tab' => $this->tab_info,
        ]);

        //  ##  TAB : MEDIAS

        $this->crud->addField([
            'name' => 'avatar',
            'type' => 'image',
            'label' => __('admin.avatar'),
            'wrapper'   => [
                'class'      => 'form-group col-md-4'
            ],
            'tab' => $this->tab_medias,
        ]);

        $this->crud->addField([
            'name' => 'header_image',
            'type' => 'image',
            'label' => __('admin.header-image'),
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
