<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use App\Scopes\EmployeeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $table = 'users';
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new EmployeeScope(2));
    }

//
//    public $rules =
//        [
//            'first_name' => 'required | max:255',
//            'last_name' => 'required | max:255',
//            'email' => 'required | max:255 email|unique:users,email',
//        ];

    protected $appends = ['initials', 'name'];

    public function getInitialsAttribute()
    {
        return ucfirst(substr($this->first_name, 0, 1)) . ucfirst(substr($this->last_name, 0, 1));
    }

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BranchInventory::class, 'branch_id');
    }

    /**
     * @param $productId
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|int|mixed
     */
    public function getInventory($productId)
    {
        $branchInventory = $this->inventory()->where([
            'product_id' => $productId
        ])->first();

        if ($branchInventory) return $branchInventory->count;
        return 0;
    }

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
