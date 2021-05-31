<?php

namespace Domain\Projects\Admin\Controllers\Traits;


/**
 * Finalitable Crud trait pour principalement l'interface CRUD des personnes et les organisations.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait FinalitableCrudTrait
{
    public function add_finalitable_columns()
    {
        if( isset($this->crud))
        {
            $this->crud->addColumn([
                'name' => 'finalitables',
                'type' => 'model_function',
                'label' => __('projects.finalities'),
                'function_name' => 'columnFinalities',
                'escaped' => false,
                'limit' => 2000,//model_function type limit at 40 if not specified. We know html could be big sometime.
            ]);
        }
    }

    public function add_finalities_fields($label='Finalité')
    {
        if( isset($this->crud))
        {
            $tab = isset($this->tab_info) ? $this->tab_info : '';
            $this->crud->addField([
                'name'  => 'all_finalities',
                'label' => $label,
                'type'  => 'repeatable',
                'fields' => [
                    [
                        'label'     => __('projects.finality'),//"Identifiant",
                        'type'      => 'select2',
                        'name'      => 'finalities',

                        // optional
                        'entity'    => 'finalities',
                        'model'     => "Domain\Projects\Models\Finality",
                        'attribute' => 'name',
                        'pivot'     => true,
                        'select_all' => true,
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ],[
                        'name'    => 'finality_value',
                        'type'    => 'text',
                        'label'   => 'Note sur la finalité',
                        'wrapper' => ['class' => 'form-group col-md-8'],
                    ]
                ],
                // optional
                'new_item_label' => 'Ajouter une finalité',
                'init_rows' => 0,
                'min_rows' => 0,
                'max_rows' => 0,
                'tab' => $tab,
            ]);
        }
    }
}
