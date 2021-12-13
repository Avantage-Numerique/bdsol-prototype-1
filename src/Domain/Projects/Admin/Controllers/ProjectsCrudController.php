<?php

namespace Domain\Projects\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Domain\Admin\Controllers\BaseCrudController;
use Domain\ContactMethods\Admin\Controllers\Traits\ContactMethodsCrudTrait;
use Domain\Identifiants\Admin\Controllers\Traits\IdentifiantsCrudTrait;
use Domain\Organisations\Admin\Controllers\Traits\OrganisationsCrudTrait;
use Domain\Persons\Admin\Controllers\Traits\PersonsCrudTrait;
use Domain\Projects\Admin\Controllers\Traits\FinalitableCrudTrait;
use Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;




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
    use FetchOperation;
    use HasUploadFields;
    use ContactMethodsCrudTrait;
    use IdentifiantsCrudTrait;
    use FinalitableCrudTrait;
    use OrganisationsCrudTrait;
    use PersonsCrudTrait;


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


        $this->add_contact_methods_columns();
        $this->add_identifiants_columns();
        $this->add_organisations_columns();
        $this->add_persons_columns();


    }

    protected function _addFields($state='all')
    {
        $tab_team = __('admin.tab-equipe');
        // INFORMATION

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

        /* Date range for the project - V.P.R */
        $this->crud->addField([
            'name' => ['starting_date', 'ending_date'],
            'type' => 'date_range',
            'label' => __('admin.ending_date'),
            'tab' => $this->tab_info,
        ]);

        //Project time lapse selector
        $this->crud->addField([
            'type' => 'select',
            'label' => 'Échéancier',
            'name' => 'time_lapse', // the relationship name in your Model
            'entity' => 'timelapse', // the relationship name in your Model
            'attribute' => 'time_lapse', // attribute on Article that is shown to admin
            'model' => "Domain\TimeLapse\Models\TimeLapse",
            'tab' => $this->tab_info,
        ]);



        // Données Finalities.
        $this->add_finalities_fields();

        
      
        

        // TEAM

        $this->crud->addField([
            'type' => "relationship",
            'name' => 'persons',
            'label' => __('admin.persons'),
            'ajax' => true,
            'inline_create' => ['entity' => 'personnes'],
            'attribute' => "fullname",
            'tab' => $tab_team,
        ]);

        $this->crud->addField([
            'type' => "relationship",
            'name' => 'organisations',
            'label' => __('admin.organisations'),
            'ajax' => true,
            'inline_create' => ['entity' => 'organisations'],
            'attribute' => "all_names",
            'tab' => $tab_team,
        ]);

        // Données de contact.
        $this->add_contact_methods_fields();   //  ## Données de contact.


        // Données Identifiant.
        $this->add_identifiants_fields();


        // MEDIAS

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



    public function fetchPersons()
    {
        return $this->fetch([
            'model' => \Domain\Persons\Models\Person::class,
            'searchable_attributes' => ['firstname', 'lastname'],
        ]);
    }

    public function fetchOrganisations()
    {
        return $this->fetch([
            'model' => \Domain\Organisations\Models\Organisation::class,
            'searchable_attributes' => ['name','legal_name'],
        ]);
    }

}
