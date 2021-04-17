<?php

namespace Domain\Organisations\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

/**
 * OrganisationCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class OrganisationsCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Domain\Organisations\Models\Organisation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/organisations');
        CRUD::setEntityNameStrings('organisation', 'organisations');
    }

    protected function _addColumns($state='all')
    {
        CRUD::setFromDb(); // columns
    }

    protected function _addFields($state='all')
    {
        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }
}
