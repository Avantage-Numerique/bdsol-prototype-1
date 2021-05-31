<?php

namespace Domain\Projects\Enums;

use \Spatie\Enum\Enum;

/**
* @method static self ()
* @method static self ()
* @method static self ()
*/
class BudgetEnum extends Enum
{

    public $slugs = array(
        'less-than-5k',
        '5k-10k',
        '10k-20k',
        '20k-50k',
        '50k-100k',
        '100k-250k',
        '250k-500k',
        '500k-1M',
        '1M-plus',
    );


    public function labels() {
        //
    }
}
