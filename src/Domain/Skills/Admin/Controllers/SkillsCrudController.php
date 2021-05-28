<?php

namespace Domain\Skills\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

/**
 * SkillCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class SkillsCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        parent::setup();
        $this->crud->setModel(\Domain\Skills\Models\Skill::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/competences');
        $this->crud->setEntityNameStrings('Compétences', 'Compétences');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->setFromDb(); // columns
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
