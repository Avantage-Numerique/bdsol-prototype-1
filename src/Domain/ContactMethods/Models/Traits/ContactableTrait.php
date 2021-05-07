<?php

namespace Domain\ContactMethods\Models\Traits;


/**
 * Contactable trait pour principalement les personnes et les organisations. Pourraient être utilise ailleurs.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 */
trait ContactableTrait
{

    //  ##  RELATION    ##  //
    public function contact_methods()
    {
        return $this->morphToMany(
            'Domain\ContactMethods\Models\ContactMethod',
            'model',
            'model_has_contact_methods',
            'model_id',
            'contact_method_id'
        )->withPivot('method_value');
    }

    /**
     * 1. Add the trait to the model
     * 2. Setup the field in the CRUD to save / manage the contact methods
     * 3. Add the field name : all_contact_methods, to the fillable arrays.
     */

    //  ##  MUTATOR ##  //

    /**
     * Save the Contact methods for the model
     * @param $value String as Json to be decode
     */
    public function setAllContactMethodsAttribute($value)
    {
        //  ##  Regroup collections for checks  ##  //

        $current_saved_methods_ids = $this->contact_methods->pluck('id');
        //$current_saved_methods_name = $this->contact_methods->pluck('name', 'id');
        $current_saved_methods_value = $this->contact_methods->pluck('pivot.method_value', 'id');

        $target_saved_methods = json_decode($value);
        foreach($target_saved_methods as $index => $method)
        {
            //  ##  UPDATE : If the mehod have alreay been saved.

            if ($this->contact_methods->contains($method->contact_methods)) {

                $current_value = $current_saved_methods_value[$method->contact_methods];

                //  ##  Check if the value has changed  ##  //
                if ($current_value !== $method->method_value) {

                    $this->contact_methods()->updateExistingPivot(
                        $method->contact_methods,
                        [
                            'method_value' => $method->method_value
                        ]
                    );
                }
            }

            //  ##  CREATE : if the contact methods doesn't exist   ##  //

            if (!$this->contact_methods->contains($method->contact_methods)) {
                //  ##  It's new, so save the value  ##  //
                $this->contact_methods()->attach(
                    $method->contact_methods,
                    [
                        'method_value' => $method->method_value
                    ]
                );
            }
        }

        //  ## DELETE methods that isn't there anymore.
        if (count($target_saved_methods) !== $current_saved_methods_value->count())
        {
            $target_saved_methods_ids = \Arr::pluck($target_saved_methods, 'contact_methods');
            $to_delete = $current_saved_methods_ids->diff($target_saved_methods_ids);

            //  ##  we already check if the value changed   ##  //
            foreach($to_delete as $method_id) {

                //  ##  It's new, so save the value  ##  //
                $this->contact_methods()->detach($method_id);
            }
        }


    }


    /**
     * Get all the relations for this relations for the repeatable field.
     * (for now 2021-05-07)
     * @return false|string as JSON
     */
    public function getAllContactMethodsAttribute()
    {
        $return_array = array();
        foreach ($this->contact_methods as $index => $contact_method)
        {
            $return_array[] = [
                'contact_methods' => $contact_method->id,
                'method_value' => $contact_method->pivot->method_value,
            ];
        }
        return json_encode($return_array);
    }
}
