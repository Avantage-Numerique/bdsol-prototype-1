<?php

namespace Domain\TimeLapse\Admin\Controllers\Traits;


/**
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author 
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait TimeLapseCrudTrait
{

    public function add_Time_Lapse_columns()
    {
        if( isset($this->crud))
        {
            $this->crud->addColumn([
                'name' => 'project_time_lapse',
                'type' => 'model_function',
                'label' => __('project_time_lapse.label'),
                'function_name' => 'columnContactMethods',
                'escaped' => false,
                'limit' => 2000,//model_function type limit at 40 if not specified. We know html could be big sometime.
            ]);
        }
    }

    public function add_Time_Lapse_fields($label='Méthodes pour entrer en contact')
    {
        if( isset($this->crud))
        {
            $tab = isset($this->tab_contact) ? $this->tab_contact : '';
            $this->crud->addField([   // repeatable
                'name'  => 'all_contact_methods',
                'label' => $label,
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
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ]
                ],
                // optional
                'new_item_label' => 'Ajouter une méthode de contact',
                'init_rows' => 0,
                'min_rows' => 0,
                'max_rows' => 0,
                'tab' => $tab,
            ]);   //  ## Données de contact.
        }
    }

}
