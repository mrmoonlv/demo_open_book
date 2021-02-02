<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'uuid',
        'property_type_id',
        'county',
        'country',
        'description',
        'address',
        'image',
        'thumbnail',
        'lat',
        'lng',
        'bedrooms',
        'bathrooms',
        'price',
        'type'
    ];

    /**
     * @return HasOne
     */
    public function type()
    {
        return $this->hasOne('App\Models\PropertyType', 'id', 'property_type_id');
    }

}
