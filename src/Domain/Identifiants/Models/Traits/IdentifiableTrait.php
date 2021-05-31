<?php

namespace Domain\Identifiants\Models\Traits;

use Domain\ContactMethods\Models\ContactMethod;
use Domain\Identifiants\Models\Identifiant;
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
 * @exemple
 * 1. Create the relation method `targetModel():BelongsToMany` in `Domain\ContactMethods\Models\ContactMethod` with the morphedByMany method call.
 * 2. Add this trait Domain\ContactMethods\Models\Traits\ContactableTrait to the target model
 * 3. Setup the field in the CRUD to save / manage the contact methods
 * 4. Add the field name : all_contact_methods, to the fillable arrays.
 *
 */
trait IdentifiableTrait
{

    public $all_identifiants_raw;

    /**
     * Events
     */

    /**
     * bootContactableTrait
     * On boot this trait, add event listence
     * @deleting : Delete the current model contact_methods saved in the pivot table.
     * @todo Add this to an observer. Check when there will be multiple event listener.
     */
    protected static function bootIdentifiableTrait()
    {
        self::deleting(function ($model) {
            $model->identifiants()->delete();
        });

        self::created(function ($model) {

            $target_saved_identifiant = json_decode($model->all_identifiants_raw);

            if (is_array($target_saved_identifiant))
            {
                foreach($target_saved_identifiant as $index => $identifiant)
                {
                    /**
                     * CREATE : if the identifiant doesn't exist
                     */
                    if ($model->id !== null) {
                        //  ##  It's new, so save the value  ##  //
                        $model->identifiants()->attach(
                            $identifiant->identifiants,
                            [
                                'model_value' => $identifiant->identifiant_value
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
    public function identifiants(): MorphToMany
    {
        return $this->morphToMany(
            'Domain\Identifiants\Models\Identifiant',
            'model',
            'model_has_identifiants',
            'model_id',
            'identifiant_id'
        )->withPivot('model_value');
    }


    /**
     * MUTATORS / ACCESSORS
     */

    /**
     * Save the identifiant for the model
     * @param $value String as Json to be decode
     */
    public function setAllIdentifiantsAttribute($value)
    {
        /**
         * Regroup collections for checks
         */
        $current_saved_methods_ids = $this->identifiants->pluck('id');
        //$current_saved_methods_name = $this->identifiants->pluck('name', 'id');
        $current_saved_methods_value = $this->identifiants->pluck('pivot.model_value', 'id');
        $this->all_identifiants_raw = $value;

        $target_saved_methods = json_decode($value);

        if (is_array($target_saved_methods))
        {
            foreach($target_saved_methods as $index => $identifiant)
            {
                /**
                 * UPDATE : If the mehod have alreay been saved.
                 */
                if ($this->identifiants->contains($identifiant->identifiants)) {

                    $current_value = $current_saved_methods_value[$identifiant->identifiants];

                    /**
                     * The method already exist, but it check if the value has changed and update it.
                     */
                    if ($current_value !== $identifiant->identifiant_value) {

                        $this->identifiants()->updateExistingPivot(
                            $identifiant->identifiants,
                            [
                                'model_value' => $identifiant->identifiant_value
                            ]
                        );
                    }
                }

                /**
                 * CREATE : if the identifiant doesn't exist
                 * if id isn't say, it's because we are in create mode. So it's the event created that is used to add these.
                 */
                if ($this->id !== null && !$this->identifiants->contains($identifiant->identifiants)) {
                    //  ##  It's new, so save the value  ##  //
                    $this->identifiants()->attach(
                        $identifiant->identifiants,
                        [
                            'model_value' => $identifiant->identifiant_value
                        ]
                    );
                }
            }
        }

        /**
         * DELETE methods that isn't there anymore.
         */
        if (count($target_saved_methods) !== $current_saved_methods_value->count())
        {
            $target_saved_methods_ids = \Arr::pluck($target_saved_methods, 'identifiants');
            $to_delete = $current_saved_methods_ids->diff($target_saved_methods_ids);

            /**
             *  we already check if the value changed
             */
            foreach($to_delete as $identifiant_id) {
                /**
                 *  It's new, so save the value
                 */
                $this->identifiants()->detach($identifiant_id);
            }
        }
    }


    /**
     * Get all the relations for this relations for the repeatable field.
     * (for now 2021-05-07)
     * @return false|string as JSON
     */
    public function getAllIdentifiantsAttribute()
    {
        $return_array = array();
        foreach ($this->identifiants as $index => $identifiant)
        {
            ray($identifiant);
            $return_array[] = [
                'identifiants' => $identifiant->id,
                'identifiant_value' => $identifiant->pivot->model_value,
            ];
        }
        return json_encode($return_array);
    }


    /**
     * Columns functions
     * @return string
     */

    public function columnIdentifiants(): string
    {
        $return = ""; $sep = " | "; $total = $this->identifiants->count()-1;
        foreach ($this->identifiants as $index => $identifiants)
        {
            $return .= $this->getIdentifiantLinkTag($identifiants).($index < $total ? $sep : "");
        }
        return $return;
    }


    /**
     * TOOLS
     */

    /**
     * Return the link value html value
     * @param ContactMethod $identifiant
     * @return string
     * @todo make that an helper or url helper add
     */
    public function getIdentifiantLinkTag(Identifiant $identifiant): string
    {
        return __('utils.default-link-structure', [
            'url' => $identifiant->base_url . $identifiant->pivot->model_value,
            'title' => $identifiant->name." - ".$identifiant->pivot->model_value,
            'label' => $identifiant->name
        ]);
    }
}
