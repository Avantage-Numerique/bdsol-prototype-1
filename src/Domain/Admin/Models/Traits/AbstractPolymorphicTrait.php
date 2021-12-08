<?php

namespace Domain\Admin\Models\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * AbstractPolymorphicTrait
 * Ajout de méthodes nécessaires pour les relations polymorphique et surtout afin d'éviter la répétition.
 *
 * @projet BDSOL
 * @organisation <avantage-numerique.org> Avantage Numérique
 * @author Marc-André Martin <marcandre@mamarmite.com>
 * @license <https://opensource.org/licenses/MIT> MIT
 *
 */
trait AbstractPolymorphicTrait
{

    /**
     * _return_attribute_to_json
     * @param $property String The relation methods as property to get the polymorphic releation values.
     * @param $form_param_name String the value of the repeatable field.
     * @return string JSON or empty of not a properties.
     * @exemple
     * Works only for 2 values per row for now. Need to implement a map function to map the properties in the more complex polymorphic relation.
     */
    protected function _return_attribute_to_json($property, $form_param_name): string
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
    }


    /**
     * @param $property String Will be called as a property
     * @return string
     */
    protected function _getRepeatableColumn($property, $target_property='name'): string
    {
        if (isset($this->$property))
        {
            $return = ""; $sep = " | "; $total = $this->$property->count() - 1;
            foreach ($this->$property as $index => $property_value) {
                ray($property_value);
                $return .= $this->getAsLinkTag($property_value, $target_property).($index < $total ? $sep : "");
            }
            return $return;
        }
        return "";
    }


    /**
     * Return the link value html value
     * @param Model $model
     * @return string
     * @todo make that an helper or url helper add
     */
    public function getAsLinkTag(Model $model, $target_property='name'): string
    {
        if (isset($model->$target_property)) {
            return $model->$target_property;
        }
        return "";
    }
}
