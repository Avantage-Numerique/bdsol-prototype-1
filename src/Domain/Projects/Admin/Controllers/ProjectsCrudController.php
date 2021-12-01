<?php

namespace Domain\Projects\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Domain\Admin\Controllers\BaseCrudController;
use Domain\ContactMethods\Admin\Controllers\Traits\ContactMethodsCrudTrait;
use Domain\Identifiants\Admin\Controllers\Traits\IdentifiantsCrudTrait;
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


        // Données Finalities.
        $this->add_finalities_fields();


        // TEAM

        $this->crud->addField([   // relationship
            'type' => "relationship",
            'name' => 'persons', // the method on your model that defines the relationship
            'ajax' => true,
            'inline_create' => [ 'entity' => 'personnes' ],
            'tab' => $tab_team,

            // OPTIONALS:
            // 'label' => "Category",
            // 'attribute' => "name", // foreign key attribute that is shown to user (identifiable attribute)
            // 'entity' => 'category', // the method that defines the relationship in your Model
            // 'model' => "App\Models\Category", // foreign key Eloquent model
            // 'placeholder' => "Select a category", // placeholder for the select2 input

            // AJAX OPTIONALS:
            // 'delay' => 500, // the minimum amount of time between ajax requests when searching in the field
            // 'data_source' => url("fetch/category"), // url to controller search function (with /{id} should return model)
            // 'minimum_input_length' => 2, // minimum characters to type before querying results
            // 'dependencies'         => ['category'], // when a dependency changes, this select2 is reset to null
            // 'include_all_form_fields'  => false, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
        ],);

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
        return $this->fetch(\Domain\Persons\Models\Person::class);
    }
}
