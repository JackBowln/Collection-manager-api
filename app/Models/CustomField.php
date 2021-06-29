<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'collection_id',
        'name',
        'label',
        'placeholder',
        'type',
        'is_required',
        'is_read_only',
        'mask',
        'values',
        'tooltip',
        'index'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
