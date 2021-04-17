<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => '\Domain',
], function () { // custom admin routes

    Route::crud('personnes', 'Persons\Admin\Controllers\PersonCrudController');
    Route::crud('organisations', 'Organisations\Admin\Controllers\OrganisationsCrudController');
    Route::crud('projets', 'Projects\Admin\Controllers\ProjectsCrudController');
    Route::crud('evenements', 'Events\Admin\Controllers\EventsCrudController');
    Route::crud('lieux', 'Places\Admin\Controllers\PlacesCrudController');
    Route::crud('competences', 'Skills\Admin\Controllers\SkillsCrudController');
    Route::crud('equipements', 'Equipments\Admin\Controllers\EquipmentsCrudController');

});

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes





}); // this should be the absolute last line of this file
