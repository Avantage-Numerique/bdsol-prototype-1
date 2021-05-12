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
                'label' => __('identifiants.label'),
                'function_name' => 'columnIdentifiants',
                'escaped' => false,
                'limit' => 2000,//model_function type limit at 40 if not specified. We know html could be big sometime.
            ]);
        }
    }

}
