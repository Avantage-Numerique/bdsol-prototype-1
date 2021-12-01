<?php

namespace Domain\Uri\Models\Traits;

use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

trait SluggableTrait
{
    use hasSlug;

    protected $default_slug_from = 'name';

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(($this->slug_from ?? $this->default_slug_from))
            ->saveSlugsTo('slug');
    }


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
