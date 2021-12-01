<?php

namespace Domain\Projects\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Domain\Admin\Controllers\BaseCrudController;
use Domain\ContactMethods\Admin\Controllers\Traits\ContactMethodsCrudTrait;
use Domain\Identifiants\Admin\Controllers\Traits\IdentifiantsCrudTrait;
use Domain\Projects\Admin\Controllers\Traits\FinalitableCrudTrait;
use Domain\Projects\Models\Finality;

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
    use FinalitableCrudTrait;

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

        /**
         * From ContactMethodsCrudTrait
         */
        $this->add_contact_methods_columns();
        $this->add_identifiants_columns();
        $this->add_finalitable_columns();

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

        /* New starting date for the project - V.P.R */
        $this->crud->addField([
            'name' => 'starting_date',
            'type' => 'timestamp',
            'label' => __('admin.starting_date'),
            'tab' => $this->tab_info,
        ]);

        /* New ending date for the project - V.P.R */
        $this->crud->addField([
            'name' => 'ending_date',
            'type' => 'timestamp',
            'label' => __('admin.ending_date'),
            'tab' => $this->tab_info,
        ]);


        //  ## Données Finalities.
        $this->add_finalities_fields();


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
