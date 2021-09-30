<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
       $delete = PackageItems::where('package_id',$item->id)->delete();
       for ($i =0; $i < count($request->id) ; $i ++){
           if($request['type'][$i] == 'Product' || $request['type'][$i] == 'App\Models\Product'){
               $packageItem = new PackageItems();
               $packageItem->package_id	 = $item->id;
               $packageItem->packageitemable_id = $request['id'][$i];
               $packageItem->quantity = $request['qty'][$i];
               $product = Product::find($request['id'][$i]);
               $product->packageItem()->save($packageItem);
           }
           if($request['type'][$i] == 'Service' || $request['type'][$i] == 'App\Models\Service'){
               $packageItem = new PackageItems();
               $packageItem->package_id	 = $item->id;
               $packageItem->packageitemable_id = $request['id'][$i];
               $packageItem->quantity = $request['qty'][$i];
               $service = Service::find($request['id'][$i]);
               $service->packageItem()->save($packageItem);
           }
       }
        return $item;
    }
    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
