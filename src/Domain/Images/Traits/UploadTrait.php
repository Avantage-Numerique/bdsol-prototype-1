<?php

namespace Domain\Images\Traits;

use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\Downloaders;

trait UploadTrait {

    use InteractsWithMedia;

    public $base_path = '/uploads';
    public $disk = 'public';
    public $field = 'avatar';

    public function saveToMediaCollection($value)
    {
        return $this->addMediaFromBase64($value) //starting method
            ->withCustomProperties(['mime-type' => 'image/jpeg'])
            ->usingFileName(\Str::random().'.jpg')
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method

        // //middle method
        //->keepOriginalImageFormat() //middle method
        /*
        addFromMediaLibraryRequest($request->avatar)
            ->toMediaCollection('avatar');*/
    }

    public function processImageFromBP($value)
    {
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = $this->disk.$this->$base_path."/avatar";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst($this->disk.'/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }


}
