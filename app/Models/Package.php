<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];

    public $rules =
        [
            'name' => 'required | max:255',
            'price' => 'required',
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PackageItems::class, 'package_id');
    }

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->name)) $item->name = $request->name;
        if (isset($request->price)) $item->price = $request->price;
        if (isset($request->category)) $item->category = $request->category;
        if (isset($request->active)) $item->active = $request->active;

        $item->save();
        return $item;
    }
}
