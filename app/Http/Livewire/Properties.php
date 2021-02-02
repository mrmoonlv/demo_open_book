<?php

namespace App\Http\Livewire;
use App\Http\Livewire\Datatables\Column\DeleteColumn;
use App\Models\Property;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Properties extends LivewireDatatable
{

    public $hideable = 'select';
    public $model = Property::class;
    public $perPage = 15;

    public function builder()
    {
        return Property::query()->leftJoin('properties_types', 'properties_types.id', 'properties.property_type_id');
    }

    public function columns()
    {
        return [
            Column::name('id')->filterable()->searchable()->sortBy('id')->defaultSort('asc')->hide(),
            Column::name('properties_types.title')->filterable()->searchable(),
            NumberColumn::name('bedrooms')->filterable()->searchable(),
            NumberColumn::name('bathrooms')->filterable()->searchable(),
            Column::name('price')->filterable()->searchable(),
            Column::name('type')->filterable()->searchable(),
            Column::name('county')->hide(),
            Column::name('country')->hide(),
            Column::name('description')->hide(),
            Column::name('address')->hide(),
            Column::name('lat')->hide(),
            Column::name('lng')->hide(),
            DeleteColumn::delete()
        ];
    }
}