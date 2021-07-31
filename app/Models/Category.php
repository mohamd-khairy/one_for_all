<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    protected $fillable = ['parent_id', 'image'];
    public $translatedAttributes = ['name', 'details'];

    public function gettranslatable()
    {
        return $this->translatedAttributes;
    }
}
