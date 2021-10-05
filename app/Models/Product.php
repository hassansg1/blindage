<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];

    public $rules =
        [
            'name' => 'required | max:255',
        ];

    public function setBackbarItemAttribute($value)
    {
        $this->attributes['backbar_item'] = $value == "on" ? 1 : 0;
    }

    /**
     * @param $value
     */
    public function setCategoryAttribute($value)
    {
        if (!is_numeric($value) || ProductCategory::find($value) == null) {
            $value = ProductCategory::createNew($value);
        }
        $this->attributes['category'] = $value;
    }

    /**
     * @param $value
     */
    public function setBrandAttribute($value)
    {
        if (!is_numeric($value) || ProductCategory::find($value) == null) {
            $value = ProductBrand::createNew($value);
        }
        $this->attributes['brand'] = $value;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BranchInventory::class, 'product_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function packageItem(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(PackageItems::class, 'packageitemable')->orderBy('id','desc');
    }


    public function appointmentBookItem(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(AppointmentBookItems::class, 'serviceitemable')->orderBy('id','desc');
    }



    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->name)) $item->name = $request->name;
        if (isset($request->backbar_item)) $item->backbar_item = $request->backbar_item;
        if (isset($request->brand)) $item->brand = $request->brand;
        if (isset($request->category)) $item->category = $request->category;
        if (isset($request->size)) $item->size = $request->size;
        if (isset($request->sku)) $item->sku = $request->sku;
        if (isset($request->wholesale_price)) $item->wholesale_price = $request->wholesale_price;
        if (isset($request->retail_price)) $item->retail_price = $request->retail_price;
        if (isset($request->count)) $item->count = $request->count;
        if (isset($request->supplier)) $item->supplier = $request->supplier;

        $item->save();
        if (isset($request->inventory))
        {
            $item->inventory()->delete();
            foreach ($request->inventory as $branch => $count)
            {
                $item->inventory()->create([
                    'product_id' => $item->id,
                    'branch_id' => $branch,
                    'count' => $count,
                ]);
            }
        }
        return $item;
    }
}
