<?php

namespace Domain\Ontology\Api;

use Spatie\Ray\Request;

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
            return response()->json($data);
        }
    }
}
