<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    public function postTranslations()
    {
        return $this->belongsToMany(PostTranslation::class);
    }
}
