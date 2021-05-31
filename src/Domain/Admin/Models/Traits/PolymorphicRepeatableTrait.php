<?php

namespace Domain\Admin\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;


/**
 *
 * PolymorphicRepeatable trait pour augmenter la vitesse d'intégration d'un lien polymorphique et d'une interface avec un repeatable field.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 *
 * @exemple
 * 1.
 *
 */
trait PolymorphicRepeatableTrait
{

    public $all_current_model_raw;

    public $model_relation_method;//finalities()
    /**
     * Events
     */

    /**
     * bootContactableTrait
     * On boot this trait, add event listence
     * @deleting : Delete the current model contact_methods saved in the pivot table.
     * @todo Add this to an observer. Check when there will be multiple event listener.
     */
    protected static function bootContactableTrait()
    {
        self::deleting(function ($model) {
            $model->finalities()->delete();
        });

        self::created(function ($model) {

            $target_saved_methods = json_decode($model->all_finalities_raw);
            foreach($target_saved_methods as $index => $method) {
                /**
                 * CREATE : if the contact methods doesn't exist
                 */
                if ($model->id !== null) {
                    //  ##  It's new, so save the value  ##  //
                    $model->contact_methods()->attach(
                        $method->finalities,
                        [
                            'method_value' => $method->finality_value
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
     * Save the Contact methods for the model
     * @param $value String as Json to be decode
     */
    public function setAllContactMethodsAttribute($value)
    {
        /**
         * Regroup collections for checks
         */
        $current_saved_methods_ids = $this->finalities->pluck('id');
        //$current_saved_methods_name = $this->contact_methods->pluck('name', 'id');
        $current_saved_methods_value = $this->finalities->pluck('pivot.method_value', 'id');
        $this->all_contact_methods_raw = $value;

        $target_saved_methods = json_decode($value);
        foreach($target_saved_methods as $index => $method)
        {
            /**
             * UPDATE : If the mehod have alreay been saved.
             */
            if ($this->finalities->contains($method->contact_methods)) {

                $current_value = $current_saved_methods_value[$method->contact_methods];

                /**
                 * The method already exist, but it check if the value has changed and update it.
                 */
                if ($current_value !== $method->method_value) {

                    $this->finalities()->updateExistingPivot(
                        $method->finalities,
                        [
                            'method_value' => $method->finality_value
                        ]
                    );
                }
            }

            /**
             * CREATE : if the contact methods doesn't exist
             * if id isn't say, it's because we are in create mode. So it's the event created that is used to add these.
             */
            if ($this->id !== null && !$this->finalities->contains($method->contact_methods)) {
                //  ##  It's new, so save the value  ##  //
                $this->finalities()->attach(
                    $method->finalities,
                    [
                        'model_value' => $method->finality_value
                    ]
                );
            }
        }

        /**
         * DELETE methods that isn't there anymore.
         */
        if (count($target_saved_methods) !== $current_saved_methods_value->count())
        {
            $target_saved_methods_ids = \Arr::pluck($target_saved_methods, 'contact_methods');
            $to_delete = $current_saved_methods_ids->diff($target_saved_methods_ids);

            /**
             *  we already check if the value changed
             */
            foreach($to_delete as $finality_id) {
                /**
                 *  It's new, so save the value
                 */
                $this->finalities()->detach($finality_id);
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
        $return_array = array();
        foreach ($this->finalities as $index => $finality)
        {
            $return_array[] = [
                'finality' => $finality->id,
                'finality_value' => $finality->pivot->model_value,
            ];
        }
        return json_encode($return_array);
    }


    /**
     * Columns functions
     * @return string
     */

    public function columnContactMethods(): string
    {
        $return = ""; $sep = " | "; $total = $this->finalities->count()-1;
        foreach ($this->finalities as $index => $finality)
        {
            $return .= $this->getfinalityLinkTag($finality).($index < $total ? $sep : "");
        }
        return $return;
    }


    /**
     * TOOLS
     */

    /**
     * getfinalityById
     * Get the target method by it's id.
     * @param $contact_method_id
     * @return mixed
     */
    public function getfinalityById($finality_id): Finality
    {
        foreach ($this->finalities as $index => $finality)
        {
            if ($finality->id = $finality_id) return $finality;
        }
    }


    /**
     * Return the link value html value
     * @param Finality $finality
     * @return string
     * @todo make that an helper or url helper add
     */
    public function getfinalityLinkTag(Finality $finality): string
    {
        return $finality->name;
    }
}
