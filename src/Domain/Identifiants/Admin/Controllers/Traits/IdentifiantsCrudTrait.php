<?php

namespace Domain\Identifiants\Admin\Controllers\Traits;


/**
 * Contact Methods trait pour principalement l'interface CRUD des personnes et les organisations.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait IdentifiantsCrudTrait
{
    public function add_identifiants_columns()
    {
        if( isset($this->crud))
        {
            $this->crud->addColumn([
                'name' => 'identifiants',
                'type' => 'model_function',
                'label' => __('identifiants.identifiants'),
                'function_name' => 'columnIdentifiants',
                'escaped' => false,
                'limit' => 2000,//model_function type limit at 40 if not specified. We know html could be big sometime.
            ]);
        }
    }

    public function add_identifiants_fields($label='Identifiant pour la personne')
    {
        if( isset($this->crud))
        {
            $tab = isset($this->tab_identifiants) ? $this->tab_identifiants : '';
            $this->crud->addField([   // repeatable
                'name'  => 'all_identifiants',
                'label' => $label,
                'type'  => 'repeatable',
                'fields' => [
                    [
                        'name'    => 'identifiant_value',
                        'type'    => 'text',
                        'label'   => 'Votre numéro ou identifiants',
                        'wrapper' => ['class' => 'form-group col-md-8'],
                    ],[
                        'label'     => "Identifiant",
                        'type'      => 'select2',
                        'name'      => 'identifiants', // the method that defines the relationship in your Model

                        // optional
                        'entity'    => 'identifiants', // the method that defines the relationship in your Model
                        'model'     => "Domain\Identifiants\Models\Identifiant", // foreign key model
                        'attribute' => 'name', // foreign key attribute that is shown to user
                        'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                        'select_all' => true, // show Select All and Clear buttons?
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ]
                ],
                // optional
                'new_item_label' => 'Ajouter un identifiant',
                'init_rows' => 0,
                'min_rows' => 0,
                'max_rows' => 0,
                'tab' => $tab,
            ]);
        }
    }
}
