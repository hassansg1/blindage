<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use App\Scopes\EmployeeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $table = 'services';
    protected $guarded = [];

    public $rules =
        [
            'name' => 'required | max:255',
        ];

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = $value == "on" ? 1 : 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function packageItem(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(PackageItems::class, 'packageitemable')->orderBy('id','desc');
    }

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->name)) $item->name = $request->name;
        if (isset($request->active)) $item->active = $request->active;
        if (isset($request->category)) $item->category = $request->category;
        if (isset($request->service_id)) $item->service_id = $request->service_id;
        if (isset($request->color)) $item->color = $request->color;
        if (isset($request->minutes)) $item->minutes = $request->minutes;
        if (isset($request->price)) $item->price = $request->price;
        if (isset($request->price)) $item->price = $request->price;

        $item->save();
        return $item;
    }
}
