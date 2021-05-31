<?php

namespace Domain\Projects\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Domain\Admin\Controllers\BaseCrudController;
use Domain\ContactMethods\Admin\Controllers\Traits\ContactMethodsCrudTrait;
use Domain\Identifiants\Admin\Controllers\Traits\IdentifiantsCrudTrait;
use  Domain\Projects\Models\Finality;

/**
 * ProjectCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class ProjectsCrudController extends BaseCrudController
{
    use HasUploadFields;
    use ContactMethodsCrudTrait;
    use IdentifiantsCrudTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        parent::setup();
        $this->crud->setModel(\Domain\Projects\Models\Project::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/projets');
        $this->crud->setEntityNameStrings('projet', 'projets');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->addColumn([
            'name' => 'logo',
            'type' => 'image',
            'label' => __('admin.logo'),
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

        $this->crud->addColumn([
            'name' => 'finality_id',
            'type' => 'select',
            'label' => __('projects.finality'),
            'entity' => 'finality',
            'attribute' => 'name',
            'model' => '\Domain\Projects\Models\Finality',
        ]);

        /**
         * From ContactMethodsCrudTrait
         */
        $this->add_contact_methods_columns();
        $this->add_identifiants_columns();

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
            'label' => __('projects.finality'),
            'type' => 'select2',
            'name' => 'finality_id',
            'entity' => 'finality',
            'model' => '\Domain\Projects\Models\Finality',
            'attribute' => 'name',
            'default' => null,
            'wrapper'   => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => $this->tab_info,
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'wysiwyg',
            'label' => __('admin.description'),
            'tab' => $this->tab_info,
        ]);


        //  ## Données de contact.
        $this->add_contact_methods_fields();   //  ## Données de contact.


        //  ## Données Identifiant.
        $this->add_identifiants_fields();


        //  ##  TAB : MEDIAS

        $this->crud->addField([
            'name' => 'logo',
            'type' => 'image',
            'label' => __('admin.logo'),
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
