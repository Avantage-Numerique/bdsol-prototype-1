<?php

namespace Domain\Ontology\Api;

/**
 * ApiController
 *
 * @projet
 * @organisation  <>
 * @author  <>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
class ApiController {


    public function __construct()
    {

    }

    public function push_data($data) {
        if (is_object($data)) {

            return json_encode($data);
        }
    }


}
