<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Product;
use App\Models\Service;

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
      // dd($request->all());
      if (isset($request->name)) $item->name = $request->name;
      if (isset($request->price)) $item->price = $request->price;
      if (isset($request->category)) $item->category = $request->category;
      if (isset($request->active)) $item->active = isset($request->active) ? $request->active:1;

      $item->save();
      $delete = PackageItems::where('package_id',$item->id)->delete();
      for ($i =0; $i < count($request->id) ; $i ++)
      {
        $packageItem = new PackageItems();
        $packageItem->package_id	 = $item->id;
        $packageItem->packageitemable_id = $request['id'][$i];
        $packageItem->quantity = $request['qty'][$i];
        // $product = $request['type'][$i]::find($request['id'][$i]);
        $classObj = '\\App\\Models\\'.$request['type'][$i];
        $product = $classObj::find($request['id'][$i]);
        $product->packageItem()->save($packageItem);
      }
    
      return $item;
    
    }
    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function service_items()
    {
      return $this->items()->where('packageitemable_type',Service::class)->get();
    }

    public function product_items()
    {
      return $this->items()->where('packageitemable_type',Product::class)->get();
    }

    public function appointmentBookItem(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(AppointmentBookItems::class, 'serviceitemable')->orderBy('id','desc');
    }

}
