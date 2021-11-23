<?php

namespace Domain\Ontology\Models\Traits;

use Domain\Ontology\Models\OntologyProperty;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 *
 * IdentifiableTrait trait pour principalement les personnes et les organisations. Pourraient être utilise ailleurs.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 *
 */
trait PropertyableTrait
{

    public $all_properties_raw;

    /**
     * Events
     */

    /**
     * bootPropertyableTrait
     * On boot this trait, add event listenner
     * @deleting : Delete the current model properties saved in the pivot table.
     * @todo Add this to an observer. Check when there will be multiple event listener.
     */
    protected static function bootPropertyableTrait()
    {
        self::deleting(function ($model) {
            $model->properties()->delete();
        });

        self::created(function ($model)
        {
            $target_saved_perperties = json_decode($model->all_properties_raw);

            if (is_array($target_saved_perperties))
            {
                foreach($target_saved_perperties as $index => $property)
                {
                    /**
                     * CREATE : if the property doesn't exist
                     */
                    if ($model->id !== null) {
                        //  ##  It's new, so save the value  ##  //
                        $model->properties()->attach(
                            $property->properties,
                            [
                                'model_value' => $property->model_value
                            ]
                        );
                    }
                }
            }

        });
    }


    /**
     * RELATIONS
     */

    /**
     * Add the n:n polymorphic relationship to the model to manage these data.
     * @return BelongsToMany
     */
    public function properties(): MorphToMany
    {
        return $this->morphToMany(
            'Domain\Ontology\Models\OntologyProperty',
            'model',
            'model_has_properties',
            'model_id',
            'property_id'
        )->withPivot('model_value');
    }


    /**
     * MUTATORS / ACCESSORS
     */

    /**
     * Save the Property for the model
     * @param $value String as Json to be decode
     */
    public function setAllPropertiesAttribute($value)
    {
        /**
         * Regroup collections for checks
         */
        //$current_ids = $this->properties->pluck('id');
        //$current_saved_methods_name = $this->properties->pluck('name', 'id');
        $current_ids = $this->properties->pluck('pivot.model_value', 'id');
        $this->all_properties_raw = $value;

        $targets = json_decode($value);

        if (is_array($targets))
        {
            foreach($targets as $index => $property)
            {
                /**
                 * UPDATE : If the mehod have alreay been saved.
                 */
                if ($this->properties->contains($property->id)) {

                    $current_value = $current_ids[$property->id];

                    /**
                     * The method already exist, but it check if the value has changed and update it.
                     */
                    if ($current_value !== $property->model_value) {

                        $this->properties()->updateExistingPivot(
                            $property->id,
                            [
                                'title' => $property->title,
                                'intro' => $property->intro
                            ]
                        );
                    }
                }

                /**
                 * CREATE : if the identifiant doesn't exist
                 * if id isn't say, it's because we are in create mode. So it's the event created that is used to add these.
                 */
                if ($this->id !== null && !$this->properties->contains($property->id)) {
                    //  ##  It's new, so save the value  ##  //
                    $this->properties()->attach(
                        $property->id,
                        [
                            'title' => $property->title,
                            'intro' => $property->intro
                        ]
                    );
                }
            }
        }

        /**
         * DELETE methods that isn't there anymore.
         */
        if (count($targets) !== $current_ids->count())
        {
            $targets_ids = \Arr::pluck($targets, 'properties');
            $to_delete = $current_ids->diff($targets_ids);

            /**
             *  we already check if the value changed
             */
            foreach($to_delete as $property_id) {
                /**
                 *  It's new, so save the value
                 */
                $this->properties()->detach($property_id);
            }
        }
    }


    /**
     * Get all the relations for this relations for the repeatable field.
     * (for now 2021-05-07)
     * @return false|string as JSON
     */
    public function getAllPropertiesAttribute()
    {
        $return_array = array();
        foreach ($this->properties as $index => $property)
        {
            $return_array[] = [
                'properties' => $property->id,
                'model_value' => $property->pivot->model_value,
            ];
        }
        return json_encode($return_array);
    }


    /**
     * Columns functions
     * @return string
     */

    public function columnProperties(): string
    {
        $return = ""; $sep = " | "; $total = $this->properties->count()-1;
        foreach ($this->properties as $index => $property)
        {
            $return .= $property->title.($index < $total ? $sep : "");
        }
        return $return;
    }
}
