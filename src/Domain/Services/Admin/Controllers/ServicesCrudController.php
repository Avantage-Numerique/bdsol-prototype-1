<?php

namespace Domain\Services\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Domain\Admin\Controllers\BaseCrudController;

/**
 * ServiceCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class ServicesCrudController extends BaseCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\Domain\Services\Models\Service::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/services');
        $this->crud->setEntityNameStrings('service', 'services');
    }

    protected function _addColumns($state='all')
    {
        $this->crud->setFromDb();
    }

    protected function _addFields($state='all')
    {
        $this->crud->setFromDb();
    }
}
