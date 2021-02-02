<?php

namespace App\Helpers;

use \App\Models\PropertyType;
use \App\Models\Property;

class ApiProperties
{

    public $api_url = null;
    public $api_key = null;
    public $size = 100;
    public $page_nr = 1;
    public $url;

    public function __construct()
    {
        $this->api_url = env("API_URL", 'http://example.com');
        $this->api_key = env("API_KEY", 'YOUR_API_KEY_HERE');
        $this->url = $this->api_url . '?api_key=' . $this->api_key . "&page[size]=" . $this->size . "&page[number]=" . $this->page_nr;
    }

    public function get()
    {
        $call = json_decode(file_get_contents($this->url));
        if (!empty($call)) {

            if (!empty($call->data)) {
                $this->saveData($call->data);
            }

            if (!empty($call->next_page_url)) {
                $this->url = $call->next_page_url;
                $this->get();
            }
        }
    }

    public function saveData($data)
    {
        if (!empty($data)) {
            foreach ($data as $item) {

                $property_type = $item->property_type;
                $property_type->id = intval($property_type->id);

                if (!empty($property_type->id)) {
                    $propertyType = PropertyType::firstOrNew(['id' => $property_type->id]);
                    $propertyType->title = (!empty($property_type->title)) ? htmlspecialchars($property_type->title) : null;
                    $propertyType->description = (!empty($property_type->description)) ? htmlspecialchars($property_type->description) : null;
                    $propertyType->created_at = (!empty($property_type->created_at)) ? $property_type->created_at : now();
                    $propertyType->updated_at = (!empty($property_type->updated_at)) ? $property_type->updated_at : now();
                    $propertyType->save();
                }

                $property = Property::firstOrNew(['uuid' => $item->uuid]);

                if(!empty($item->property_type_id)) {
                    if(!empty(intval($item->property_type_id))) {
                        $property->property_type_id = $item->property_type_id;
                    }
                }

                $property->county = (!empty($item->county)) ? htmlspecialchars($item->county) : null;
                $property->country = (!empty($item->country)) ? htmlspecialchars($item->country) : null;
                $property->description = (!empty($item->description)) ? htmlspecialchars($item->description) : null;
                $property->address = (!empty($item->address)) ? htmlspecialchars($item->address) : null;
                $property->address = (!empty($item->address)) ? htmlspecialchars($item->address) : null;
                $property->image = (!empty($item->image_full)) ? htmlspecialchars($item->image_full) : null;
                $property->thumbnail = (!empty($item->image_thumbnail)) ? htmlspecialchars($item->image_thumbnail) : null;
                $property->lat = (!empty($item->latitude)) ? htmlspecialchars($item->latitude) : null;
                $property->lng = (!empty($item->longitude)) ? htmlspecialchars($item->longitude) : null;
                $property->bedrooms = intval($item->num_bedrooms);
                $property->bathrooms = intval($item->num_bathrooms);
                $property->price = (!empty($item->price)) ? htmlspecialchars($item->price / 100) : null;
                $property->type = (!empty($item->type)) ? htmlspecialchars($item->type) : null;
                $property->created_at = (!empty($property->created_at)) ? $item->created_at : now();
                $property->updated_at = (!empty($property->updated_at)) ? $item->updated_at : now();

                $property->save();
            }
        }
    }

}
