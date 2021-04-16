<?php

namespace Domain\Admin\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * PersonCrudController
 * Gestion des entités personnes
 * @projet BDSOL
 * @organisation Avantage Numérique <avantage-numerique.org>
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class BaseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation {
        show as traitShow;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation {
        index as traitList;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        create as traitCreate;
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
        edit as traitEdit;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {
        destroy as traitDelete;
    }


    public function setupListOperation()
    {
        $this->_addColumns('list');
        $this->_addFilters('list');
        $this->_setQuery('list');
    }


    public function setupCreateOperation()
    {
        $this->_addFields('create');
    }


    public function setupUpdateOperation()
    {
        $this->_addFields('update');
    }


    //  ##  CRUD Methods    ##  //

    public function setup() {
        parent::setup();
    }

    public function index()
    {
        return $this->traitList();
    }

    public function create()
    {
        return $this->traitCreate();
    }

    public function store()
    {
        return $this->traitStore();
    }

    public function edit($id)
    {
        return $this->traitEdit($id);
    }

    public function show($id)
    {
        return $this->traitShow($id);
    }

    public function destroy($id)
    {
        return $this->traitDelete($id);
    }


    //  ##  Private methods for columns, fields, filters, etc.  ##  //

    protected function _addColumns($state='all')
    {

    }


    protected function _addFields($state='all')
    {

    }


    protected function _addFilters($state='all')
    {

    }


    protected function _setQuery($state='all')
    {

    }
}
