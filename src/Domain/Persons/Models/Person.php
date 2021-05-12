<?php

namespace Domain\Persons\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Domain\ContactMethods\Models\Traits\ContactableTrait;
use Domain\Identifiants\Models\Traits\IdentifiableTrait;
use Domain\Images\Traits\AvatarTrait;
use Domain\Uri\Models\Traits\SluggableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// implements HasMedia


class Person extends Model
{
    use CrudTrait;
    use SluggableTrait;
    //use HasUploadFields;
    //use InteractsWithMedia;
    //use AvatarTrait;
    use ContactableTrait;
    use IdentifiableTrait;

    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'firstname',
        'lastname',
        'nickname',
        'address',
        'description',
        'logo',
        'avatar',
        'header_image',
        'all_contact_methods',  //polymorphic relation table.
        'all_contact_methods_raw',  //polymorphic relation table.
        'updated_at',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'all_contact_methods_raw'
    ];



    //  ##  Relations   ##  //


    //  ##  MUTATORS    ##  //


    /**
     * Concatenate the firstname and lastname value, to avoid having a column for that.
     * @return string
     */
    public function getNameAttribute() {
        return $this->firstname." ".$this->lastname;
    }


    /**
     * Use Backpack upload field to save the image on target storage.
     * @param $value String with base64 value.
     */
    public function setAvatarAttribute($value) {

        //$this->uploadFileToDisk($value, "avatar", "public","persons/avatars/");
        $attribute_name = "avatar";
        $disk = "public";
        $destination_path = "persons/avatars/";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (\Str::startsWith($value, 'data:image'))
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
            $public_destination_path = \Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $filename;//$public_destination_path.'/'.
        }
    }



    //  ##  TOOLS   ##  //
}
