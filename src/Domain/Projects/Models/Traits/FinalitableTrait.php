<?php

namespace Domain\Projects\Models\Traits;

use Domain\Projects\Models\Finality;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * Contactable trait pour principalement les personnes et les organisations. Pourraient être utilise ailleurs.
 * C'est pourquoi j'ai choisi une relation polymorphique pour celle-ci.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 *
 * @exemple
 * 1. Create the relation method `targetModel():BelongsToMany` in `Domain\ContactMethods\Models\ContactMethod` with the morphedByMany method call.
 * 2. Add this trait Domain\ContactMethods\Models\Traits\ContactableTrait to the target model
 * 3. Setup the field in the CRUD to save / manage the contact methods
 * 4. Add the field name : all_contact_methods, to the fillable arrays.
 *
 */
trait FinalitableTrait
{

    public $all_finalities_raw;
    public $model_relation_method;

    /**
     * Events
     */

    /**
     * bootFinalitableTrait
     * On boot this trait, add event listence
     * @deleting : Delete the current model contact_methods saved in the pivot table.
     */
    protected static function bootFinalitableTrait()
    {
        self::deleting(function ($model) {
            $model->finalities()->delete();
        });

        /**
         * ON CREATED : Assume that isn't saved on create.
         */
        self::created(function ($model) {

            $target_saved = json_decode($model->all_finalities_raw);
            foreach($target_saved as $index => $model) {

                if ($model->id !== null) {
                    //  ##  It's new, so save the value  ##  //
                    $model->finalities()->attach(
                        $model->finalities,
                        [
                            'method_value' => $model->finality_value
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
    public function finalities(): MorphToMany
    {
        return $this->morphToMany(
            'Domain\Projects\Models\Finality',
            'model',
            'model_has_finalities',
            'model_id',
            'finality_id'
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
    public function setAllFinalitiesAttribute($value)
    {
        $model_method = 'finalities';
        $form_param = 'finality';

        //Regroup collections for checks
        $current_ids = $this->$model_method->pluck('id');

        $current_values = $this->$model_method->pluck('pivot.model_value', 'id');

        //  Save the value in a property for the created event.
        $this->all_finalities_raw = $value;

        $target_saved = json_decode($value);
        foreach($target_saved as $index => $entry)
        {
            /**
             * UPDATE : If the mehod have alreay been saved.
             */
            if ($this->$model_method->contains($entry->$model_method))
            {
                $current_value = $current_values[$entry->$model_method];

                // The method already exist, but it check if the value has changed and update it.
                if ($current_value !== $entry->finality_value) {
                    $form_property = $form_param.'_value';
                    $this->finalities()->updateExistingPivot(
                        $entry->$model_method,
                        [
                            'model_value' => $entry->$form_property   //finality_value
                        ]
                    );
                }
            }

            /**
             * CREATE : if the contact methods doesn't exist
             * if id isn't say, it's because we are in create mode. So it's the event created that is used to add these.
             */
            if ($this->id !== null && !$this->$model_method->contains($entry->$model_method))
            {
                $form_property = $form_param.'_value';
                //  ##  It's new, so save the value  ##  //
                $this->$model_method()->attach(
                    $entry->$model_method,
                    [
                        'model_value' => $entry->$form_property
                    ]
                );
            }
        }

        /**
         * DELETE methods that isn't there anymore.
         */
        if (count($target_saved) !== $current_values->count())
        {
            $target_saved_ids = \Arr::pluck($target_saved, $model_method);
            $to_delete = $current_ids->diff($target_saved_ids);

            //we already check if the value changed
            foreach($to_delete as $id)
            {
                //  It's new, so save the value
                $this->$model_method()->detach($id);
            }
        }
    }


    /**
     * Get all the relations for this relations for the repeatable field.
     * (for now 2021-05-07)
     * @return false|string as JSON
     */
    public function getAllFinalitiesAttribute()
    {
        return $this->_return_attribute_to_json('finalities', 'finality');
    }


    /**
     * @param $property String The relation methods as property to get the polymorphic releation values.
     * @param $form_param_name the value of the repeatable field.
     * @return string JSON or empty of not a properties.
     * @exemple
     * Works only for 2 values per row for now. Need to implement a map function to map the properties in the a more complex polymorphic relation.
     */
    protected function _return_attribute_to_json($property, $form_param_name): string
    {
        if (isset($this->$property))
        {
            $return_array = array();
            foreach ($this->$property as $index => $target_property)
            {
                $return_array[] = [
                    $property => $target_property->id,
                    $form_param_name.'_value' => $target_property->pivot->model_value,
                ];
            }
            return json_encode($return_array);
        }
        return "";
    }


    /**
     * Columns functions
     * @return string
     */
    public function columnFinalities(): string
    {
        return $this->_getRepeatableColumn('finalities');
    }


    protected function _getRepeatableColumn($property): string
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
    }


    //  TOOLS

    /**
     * Return the link value html value
     * @param Finality $finality
     * @return string
     * @todo make that an helper or url helper add
     */
    public function getAsLinkTag(Model $model): string
    {
        return $model->name;
    }
}
