<?php

namespace Database\Seeders;

use Domain\Ontology\Models\OntologyClass;
use Illuminate\Database\Seeder;

class SeedOntologyClasses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            [
                'title' => 'Personne',
                'slug' => 'person',
                'intro' => 'Lorem ipsum',
                'description' => 'Lorem ipsum',
                'source' => ''
            ],
            [
                'title' => 'Organisme',
                'slug' => 'organisme',
                'intro' => 'Lorem ipsum',
                'description' => 'Lorem ipsum',
                'source' => ''
            ],
            [
                'title' => 'Équipement',
                'slug' => 'equipement',
                'intro' => 'Lorem ipsum',
                'description' => 'Lorem ipsum',
                'source' => ''
            ],
            [
                'title' => 'Compétences',
                'slug' => 'competences',
                'intro' => 'Lorem ipsum',
                'description' => 'Lorem ipsum',
                'source' => ''
            ]
        ];

        foreach($classes as $index => $onto_class_raw) {
            $current_class = OntologyClass::create($onto_class_raw);
        }
    }
}
