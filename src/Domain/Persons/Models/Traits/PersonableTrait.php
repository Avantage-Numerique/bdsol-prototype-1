<?php

namespace Domain\Persons\Models\Traits;

use Domain\Persons\Models\Person;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * Personable trait, ajoute des champs pour la relation polymorphique qui les unis.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 *
 * @exemple
 * 1. Create the relation method `targetModel():BelongsToMany` the morphedByMany method call.
 * 2. Add this trait to the target model
 * 3. Setup the field in the CRUD to save / manage the contact methods
 * 4. Add the field name : all_contact_methods, to the fillable arrays.
 *
 */
trait PersonableTrait
{

    public $all_persons_raw;

    /**
     * Events
     */

    /**
     * bootPersonableTrait
     * On boot this trait, add event listence
     * @deleting : Delete the current model contact_methods saved in the pivot table.
     */
    protected static function bootPersonableTrait()
    {
        self::deleting(function ($model) {
            $model->persons()->delete();
        });

        /**
         * ON CREATED : Assume that isn't saved on create.
         */
        //this doesn't work.
        self::created(function ($model) {

            $model_relationship_method = 'persons';
            $model_all_relationship_raw_property = 'all_persons_raw';
            $form_param_id = 'person';
            $form_param_value = 'person_value';

            $target_saved = json_decode($model->$model_all_relationship_raw_property);

            foreach($target_saved as $index => $method)
            {
                if ($model->id !== null)
                {
                    // It's new, so save the value
                    $model->$model_relationship_method()->attach(
                        $method->$form_param_id,
                        [
                            'model_value' => $method->$form_param_value
                        ]
                    );
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
    public function persons(): MorphToMany
    {
        return $this->morphToMany(
            'Domain\Persons\Models\Person',
            'model',
            'model_has_persons',
            'model_id',
            'person_id'
        )->withPivot('model_value');
    }


    /**
     * MUTATORS / ACCESSORS
     */

    /**
     * setAllFinalitiesAttribute
     * Save the Contact methods for the model
     * @param $value String as Json to be decode
     * @todo Simplify this by separate the save, update and delete parts. Use that in created (save).  It make the loop clearer to read.
     */
    public function setAllPersonsAttribute($value)
    {
        $model_method = 'persons';
        $form_param = 'person';
        $form_property = $form_param.'_value';

        //Regroup collections for checks
        $current_ids = $this->$model_method->pluck('id');

        $current_values = $this->$model_method->pluck('pivot.model_value', 'id');

        //  Save the value in a property for the created event.
        $this->all_persons_raw = $value;

        $target_saved = json_decode($value);
        if (isset($target_saved) && !empty($target_saved)) {
            foreach($target_saved as $index => $entry)
            {
                /**
                 * UPDATE : If this have alreay been saved.
                 */
                if ($this->$model_method->contains($entry->$form_param))
                {
                    $current_value = $current_values[$entry->$form_param];

                    // The method already exist, but it check if the value has changed and update it.
                    if ($current_value !== $entry->$form_property) {
                        $this->persons()->updateExistingPivot(
                            $entry->$form_param,
                            [
                                'model_value' => $entry->$form_property   //finality_value
                            ]
                        );
                    }
                }

                /**
                 * CREATE : if this entry doesn't exist
                 * if id isn't say, it's because we are in create mode. So it's the event created that is used to add these.
                 */
                if ($this->id !== null && !$this->$model_method->contains($entry->$form_param))
                {
                    //  ##  It's new, so save the value  ##  //
                    $this->$model_method()->attach(
                        $entry->$form_param,
                        [
                            'model_value' => $entry->$form_property
                        ]
                    );
                }
            }

            //updates currents values, after the create.
            $current_values = $this->$model_method->pluck('pivot.model_value', 'id');
            $current_ids = $this->$model_method->pluck('id');

            /**
             * DELETE methods that isn't there anymore.
             */
            if (count($target_saved) !== $current_values->count())
            {
                $target_saved_ids = \Arr::pluck($target_saved, $form_param);
                $to_delete = $current_ids->diff($target_saved_ids);

                //we already check if the value changed
                foreach($to_delete as $id)
                {
                    //  It's new, so save the value
                    $this->$model_method()->detach($id);
                }
            }
        }
    }


    /**
     * Get all the relations for this relations for the repeatable field.
     * (for now 2021-05-07)
     * @return false|string as JSON
     */
    public function getAllPersonsAttribute()
    {
        return $this->_return_attribute_to_json('persons', 'person');
    }


    /**
     * @param $property String The relation methods as property to get the polymorphic releation values.
     * @param $form_param_name String the value of the repeatable field.
     * @return string JSON or empty of not a properties.
     * @exemple
     * Works only for 2 values per row for now. Need to implement a map function to map the properties in the a more complex polymorphic relation.
     */
    /*protected function _return_attribute_to_json($property, $form_param_name): string
    {
        if (isset($this->$property))
        {
            $return_array = array();
            foreach ($this->$property as $index => $target_property)
            {
                $return_array[] = [
                    $form_param_name => $target_property->id,
                    $form_param_name.'_value' => $target_property->pivot->model_value,
                ];
            }
            return json_encode($return_array);
        }
        return "";
    }*/


    /**
     * Columns functions
     * @return string
     */
    public function columnPersons(): string
    {
        return $this->_getRepeatableColumn('persons');
    }


    /*protected function _getRepeatableColumn($property): string
    {
        if (isset($this->$property))
        {
            $return = ""; $sep = " | "; $total = $this->$property->count() - 1;
            foreach ($this->$property as $index => $property_value)
            {
                $return .= $this->getAsLinkTag($property_value).($index < $total ? $sep : "");
            }
            return $return;
        }
        return "";
    }*/


    //  TOOLS
}
