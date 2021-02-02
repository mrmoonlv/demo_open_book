<?php

namespace App\Http\Livewire\Datatables\Column;

use Mediconesystems\LivewireDatatables\Column;

class DeleteColumn extends Column
{

    public static function delete($name = 'id')
    {
        return static::callback($name, function ($value) {
            return view('datatables.delete', ['value' => $value]);
        });
    }
}
