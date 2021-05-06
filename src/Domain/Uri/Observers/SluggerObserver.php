<?php

namespace Domain\Uri\Observers;

use Illuminate\Database\Eloquent\Model;

/**
 * Deprecated, Switch to spatie/laravel-sluggable instead
 */
class SluggerObserver
{

    /**
     *	Will observe all model that have slug and set this.
     *	Flaws : parameters don't have type, assume the main property for the slug is name.
     */
    public function creating(Model $targetModelWithSlug)
    {
        $this->_set_slug($targetModelWithSlug);
    }


    /**
     *	Will observe all model that have slug and set this.
     *	Flaws : parameters don't have type, assume the main property for the slug is name.
     */
    public function updating(Model $targetModelWithSlug)
    {
        $this->_set_slug($targetModelWithSlug);
    }


    protected function _set_slug($targetModelWithSlug)
    {
        if (!empty($targetModelWithSlug->name))
        {
            $targetModelWithSlug->slug = $this->_create_slug(class_basename($targetModelWithSlug), $targetModelWithSlug->name, $targetModelWithSlug->id);
        }
        elseif (!empty($targetModelWithSlug->title))
        {
            $targetModelWithSlug->slug = $this->_create_slug(class_basename($targetModelWithSlug), $targetModelWithSlug->title, $targetModelWithSlug->id);
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
