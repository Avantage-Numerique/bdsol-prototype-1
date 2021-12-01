<?php

namespace Domain\Uri\Observers;

use Illuminate\Database\Eloquent\Model;

/**
 * Deprecated, Switch to spatie/laravel-sluggable instead
 */
class SluggerObserver
{

    protected $supported_base_properties = ['name', 'title'];


    /**
     *	Will observe all model that have slug and set this.
     */
    public function creating(Model $targetModelWithSlug)
    {
        $this->_set_slug($targetModelWithSlug);
    }


    /**
     *	Will observe all model that have slug and set this.
     */
    public function updating(Model $targetModelWithSlug)
    {
        $this->_set_slug($targetModelWithSlug);
    }


    protected function _set_slug(Model $targetModelWithSlug)
    {
        foreach ($this->supported_base_properties as $base_property) {
            if (isset($targetModelWithSlug->$base_property) &&
                !empty($targetModelWithSlug->$base_property))
            {
                $newslug = $this->_create_slug(
                    get_class($targetModelWithSlug),
                    $targetModelWithSlug->$base_property,
                    $targetModelWithSlug->id
                );

                $targetModelWithSlug->slug = $newslug;
                $targetModelWithSlug["slug"] = $newslug;
            }
        }
    }


    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    protected function _create_slug($class, $title, $id = 0)
    {
        // Normalize the title
        $slug = \Str::slug($title, config('uri.uri-seperator'));

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->_get_related_slugs($class, $slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug))
        {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= config('uri.max-number-when-duplicate'); $i++)
        {
            $newSlug = $slug.config('uri.uri-seperator').$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    protected function _get_related_slugs($class, $slug, $id = 0)
    {
        if (isset($class::$have_translations) && $class::$have_translations)
        {
            $locale = \App::getLocale();
            return $class::where('slug', 'regexp', "\"{$locale}\"\s*:\s*\"{$slug}\"")
                ->where('id', '<>', $id)
                ->get();
        }
        else
        {
            return $class::select('slug')->where('slug', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
        }
    }

}
