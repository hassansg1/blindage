<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->first_name)) $item->first_name = $request->first_name;
        if (isset($request->last_name)) $item->last_name = $request->last_name;
        $item->usertype_id = 2;
        if (isset($request->mobile_no)) $item->mobile_no = $request->mobile_no;
        if (isset($request->alt_mobile_no)) $item->alt_mobile_no = $request->alt_mobile_no;
        if (isset($request->dob)) $item->dob = $request->dob;
        if (isset($request->email)) $item->email = $request->email;
        if (isset($request->active)) $item->active = $request->active;
        if (isset($request->address_line_1)) $item->address_line_1 = $request->address_line_1;
        if (isset($request->address_line_2)) $item->address_line_2 = $request->address_line_2;
        if (isset($request->city)) $item->city = $request->city;
        if (isset($request->postal_code)) $item->postal_code = $request->postal_code;
        if (isset($request->postal_code)) $item->postal_code = $request->postal_code;

        $item->save();
        return $item;
    }
}
