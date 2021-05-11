<?php

namespace Domain\ContactMethods\Admin\Controllers\Traits;


/**
 * Contact Methods trait pour principalement l'interface CRUD des personnes et les organisations.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait ContactMethodsCrudTrait
{

    public function add_contact_methods_columns()
    {
        if( isset($this->crud))
        {
            $this->crud->addColumn([
                'name' => 'contact_methods',
                'type' => 'model_function',
                'label' => __('contact-methods.label'),
                'function_name' => 'columnContactMethods',
                'escaped' => false,
                'limit' => 2000,//model_function type limit at 40 if not specified. We know html could be big sometime.
            ]);
        }
    }

}
