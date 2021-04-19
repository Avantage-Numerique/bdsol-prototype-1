<?php

namespace Domain\Images\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait AvatarTrait {

    use UploadTrait;

    public function setAvatarAttribute($value)
    {
        $return = $this->saveToMediaCollection($value);

        $this->avatar = $return;//$this->processImage($value);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);
    }
}
