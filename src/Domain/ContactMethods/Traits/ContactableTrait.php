<?php

namespace Domain\ContactMethods\Traits;

use Domain\ContactMethods\Models\Contactable;


/**
 * Contactable trait pour principalement les personnes et les organisations. Pourraient être utilise ailleurs.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait ContactableTrait {

    //  ##  Add the relation with the model

    public function contactable()
    {
        return $this->morphMany(Contactable::class, 'contactable');
    }

}
