<?php

namespace Domain\Ontology\Api;

use Domain\Ontology\Models\OntologyClass;

/**
 * OntologyClassesCrudController
 *
 * @projet
 * @organisation <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class OntologyClassesController extends ApiController
{

    public function index()
    {
        $all_classes = OntologyClass::get();
        return $this->push_data($all_classes);
    }

    public function target($class_slug)
    {

        $target_class = OntologyClass::where('slug', $class_slug)->first();
        return $this->push_data($target_class);
    }


}
