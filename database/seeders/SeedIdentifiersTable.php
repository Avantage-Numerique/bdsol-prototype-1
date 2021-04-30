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
                'base_url' => 'International Standard Book Number - numéro unique attribué à chaque livre publié dans le monde',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'ISBN 13',
                'slug' => 'isbn-13',
                'description' => 'L\'International Standard Book Number (ISBN) ou Numéro international normalisé du livre est un numéro internationalement reconnu.',
                'base_url' => 'International Standard Book Number - numéro unique attribué à chaque livre publié dans le monde',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Identifiant item Wikidata',
                'slug' => 'wikidata',
                'description' => 'Encyclopédie libre',
                'base_url' => 'https://www.wikidata.org/wiki/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Identifiant Wikipédia',
                'slug' => 'wikipedia',
                'description' => 'Encyclopédie libre',
                'base_url' => 'wikipedia.org/wiki/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Régie du cinéma du Québec',
                'slug' => 'regie-du-cinema-du-quebec',
                'description' => 'Système de classification de film',
                'base_url' => 'rcq.gouv.qc.ca',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'MusicBrainz',
                'slug' => 'musicbrainz',
                'description' => 'MusicBrainz is an open music encyclopedia that collects music metadata and makes it available to the public.',
                'base_url' => 'https://musicbrainz.org/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Artsdata',
                'slug' => 'artsdata',
                'description' => 'Artsdata.ca vise à donner au secteur des arts du Canada la possibilité d’optimiser des données ouvertes liées et à promouvoir activement un écosystème numérique plus juste et équitable. Cette initiative procède à la construction d’un graphe de connaissances pour les arts qui soit lisible par machine, ouvert et accessible à tout le monde.',
                'base_url' => 'http://kg.artsdata.ca/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'SynapeC',
                'slug' => 'regie-du-cinema-du-quebec',
                'description' => 'Mutualisation fermé',
                'base_url' => 'rcq.gouv.qc.ca',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'REQ',
                'slug' => 'req',
                'description' => 'Régistraire des entreprises',
                'base_url' => 'registreentreprises.gouv.qc.ca',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'VIAF ID',
                'slug' => 'Fichier d\'autorité international virtuel',
                'description' => 'Régistraire des entreprises',
                'base_url' => 'viaf.org',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Library of Congress',
                'slug' => 'library-of-congress',
                'description' => 'While Library of Congress buildings are closed to the public, resources and events are available to use and experience remotely.',
                'base_url' => 'loc.gov',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'Worldcat',
                'slug' => 'worldcat',
                'description' => 'WorldCat.org lets you search the collections of libraries in your community and thousands more around the world. WorldCat grows every day thanks to the efforts of librarians and other information professionals.',
                'base_url' => 'worldcat.org',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'L\'infocentre littéraire des écrivains',
                'slug' => 'lile',
                'description' => ' Depuis maintenant dix ans, l\'Infocentre littéraire des écrivains, L’ÎLE, met en ligne les biographies et bibliographies de plus de 1 000 écrivains québécois, et 360 dossiers de presse.',
                'base_url' => 'litterature.org/',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ],[
                'name' => 'International Standard Serial Number',
                'slug' => 'ISSN',
                'description' => 'L\'International Standard Serial Number ou Numéro international normalisé des publications en série est un numéro international qui permet d\'identifier de manière unique une publication en série.',
                'base_url' => 'www.bac-lac.gc.ca/fra/services/issn-canada/Pages/issn-canada.aspx',
                'connection_method' => 'HTTP',
                'is_syncable' => false,
            ]
        ];

        foreach($identifiers as $index => $identifier) {
            $current = Identifiant::create($identifier);
        }
    }
}
