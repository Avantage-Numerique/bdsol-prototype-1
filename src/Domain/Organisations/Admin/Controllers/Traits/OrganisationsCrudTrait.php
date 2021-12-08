<?php

namespace Domain\Organisations\Admin\Controllers\Traits;


/**
 * Organisations Crud trait pour principalement l'interface CRUD
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait OrganisationsCrudTrait
{
    public function add_organisations_columns()
    {
        if( isset($this->crud))
        {
            $this->crud->addColumn([
                'name' => 'organisations',
                'type' => 'model_function',
                'label' => __('organisations.organisations'),
                'function_name' => 'columnOrganisations',
                'escaped' => false,
                'limit' => 2000,
            ]);
        }
    }
}
