<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $seeders = array(
            AddPermissionsVersion1::class,
            AddAdminOnlyPermission::class,
            SeedContactsMethodsTable::class,
            SeedIdentifiersTable::class,
            AddOccupationArtistique::class,
            AddMarcAndreUser::class,
            AddFinalitiesValues::class,
            AddLevelsValues::class,
            AddMediaTypesValues::class,
            AddEventTypesValues::class,
            AddOperationTypesValues::class,
            AddOrganisationTypesValues::class,
            AddPlaceTypesValues::class,
            AddEntityRolesValues::class,
        );
        foreach($seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
