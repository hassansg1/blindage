<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];

    public $rules =
        [
            'short_name' => 'required | max:255',
            'long_name' => 'required | max:255',
            'code' => 'required | max:255',
            'contact_person' => 'required | max:255',
            'ot_apn' => 'required | max:255',
        ];

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        $item->short_name = $request->short_name;
        $item->long_name = $request->long_name;
        $item->code = $request->code;
        $item->contact_person = $request->contact_person;
        $item->ot_apn = $request->ot_apn;
        $item->save();

        return $item;
    }
}
