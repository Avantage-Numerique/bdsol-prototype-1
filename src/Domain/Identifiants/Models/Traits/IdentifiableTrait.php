<?php

namespace Domain\ContactMethods\Models\Traits;

use Domain\ContactMethods\Models\ContactMethod;
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
    protected static function bootContactableTrait()
    {
        self::deleting(function ($model) {
            //$model->contact_methods()->delete();
        });

        self::created(function ($model) {

            //$target_saved_methods = json_decode($model->all_contact_methods_raw);
            //foreach($target_saved_methods as $index => $method) {
            //    /**
            //     * CREATE : if the contact methods doesn't exist
            //     */
            //    if ($model->id !== null) {
            //        //  ##  It's new, so save the value  ##  //
            //        $model->contact_methods()->attach(
            //            $method->contact_methods,
            //            [
            //                'method_value' => $method->method_value
            //            ]
            //        );
            //    }
            //}
        });
    }


    /**
     * RELATIONS
     */

    /**
     * Add the n:n polymorphic relationship to the model to manage these data.
     * @return BelongsToMany
     */
    public function contact_methods(): MorphToMany
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
        $current_saved_methods_ids = $this->contact_methods->pluck('id');
        //$current_saved_methods_name = $this->contact_methods->pluck('name', 'id');
        $current_saved_methods_value = $this->contact_methods->pluck('pivot.method_value', 'id');
        $this->all_contact_methods_raw = $value;

        $target_saved_methods = json_decode($value);
        foreach($target_saved_methods as $index => $method)
        {
            /**
             * UPDATE : If the mehod have alreay been saved.
             */
            if ($this->contact_methods->contains($method->contact_methods)) {

                $current_value = $current_saved_methods_value[$method->contact_methods];

                /**
                 * The method already exist, but it check if the value has changed and update it.
                 */
                if ($current_value !== $method->method_value) {

                    $this->contact_methods()->updateExistingPivot(
                        $method->contact_methods,
                        [
                            'method_value' => $method->method_value
                        ]
                    );
                }
            }

            /**
             * CREATE : if the contact methods doesn't exist
             * if id isn't say, it's because we are in create mode. So it's the event created that is used to add these.
             */
            if ($this->id !== null && !$this->contact_methods->contains($method->contact_methods)) {
                //  ##  It's new, so save the value  ##  //
                $this->contact_methods()->attach(
                    $method->contact_methods,
                    [
                        'method_value' => $method->method_value
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
            foreach($to_delete as $method_id) {
                /**
                 *  It's new, so save the value
                 */
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

    public function getContactMethodAttribute()
    {

    }


    /**
     * Columns functions
     * @return string
     */

    public function columnContactMethods(): string
    {
        $return = ""; $sep = " | "; $total = $this->contact_methods->count()-1;
        foreach ($this->contact_methods as $index => $method)
        {
            $return .= $this->getContactMethodLinkTag($method).($index < $total ? $sep : "");
        }
        return $return;
    }


    /**
     * TOOLS
     */

    /**
     * getContactMethodById
     * Get the target method by it's id.
     * @param $contact_method_id
     * @return mixed
     */
    public function getContactMethodById($contact_method_id): ContactMethod
    {
        foreach ($this->contact_methods as $index => $method)
        {
            if ($method->id = $contact_method_id) return $method;
        }
    }


    /**
     * Return the link value html value
     * @param ContactMethod $method
     * @return string
     * @todo make that an helper or url helper add
     */
    public function getContactMethodLinkTag(ContactMethod $method): string
    {
        $link_tag = '<a href=":url" title=":title">:label</a>';
        return __($link_tag, [
            'url' => $method->link_prefix . $method->base_url . $method->pivot->method_value,
            'title' => $method->name." - ".$method->pivot->method_value,
            'label' => $method->name
        ]);
    }
}
