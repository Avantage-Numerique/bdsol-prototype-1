<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Identifiants\Models\Identifiant;

class SeedIdentifiersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $identifiers = [
            [
                'name' => 'ISNI',
                'slug' => 'isni',
                'description' => 'Le Code international normalisé des noms (ISNI, de l\'anglais : International Standard Name Identifier).',
                'base_url' => 'https://isni.org/isni/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'ISBN 10',
                'slug' => 'isbn-10',
                'description' => 'L\'International Standard Book Number (ISBN) ou Numéro international normalisé du livre est un numéro internationalement reconnu.',
                'base_url' => '',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'ISBN 13',
                'slug' => 'isbn-13',
                'description' => 'L\'International Standard Book Number (ISBN) ou Numéro international normalisé du livre est un numéro internationalement reconnu.',
                'base_url' => '',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Identifiant item Wikidata',
                'slug' => 'wikidata',
                'description' => '.',
                'base_url' => 'https://www.wikidata.org/wiki/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Identifiant Wikipédia',
                'slug' => 'wikipedia',
                'description' => '',
                'base_url' => 'https://www.wikipedia.org/wiki/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ]
        ];

        foreach($identifiers as $index => $identifier) {
            $current = Identifiant::create($identifier);
        }
    }
}
