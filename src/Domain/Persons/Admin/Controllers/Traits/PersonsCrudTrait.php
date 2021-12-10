<?php

namespace Domain\Persons\Admin\Controllers\Traits;


/**
 * Persons Crud trait pour principalement l'interface CRUD
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait PersonsCrudTrait
{
    public function add_persons_columns()
    {
        if( isset($this->crud))
        {
            $this->crud->addColumn([
                'name' => 'persons',
                'type' => 'model_function',
                'label' => __('persons.persons'),
                'function_name' => 'columnPersons',
                'escaped' => false,
                'limit' => 2000,
            ]);
        }
    }
}
