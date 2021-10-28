<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CashDrawer extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];

    public $rules =
        [
            'branch_id' => 'required',
            'cash_date' => 'required',
        ];

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->branch_id)) $item->branch_id = $request->branch_id;
        if (isset($request->cash_date)) $item->cash_date = $request->cash_date;
        if (isset($request->time_from)) $item->time_from = $request->time_from;
        if (isset($request->time_to)) $item->time_to = $request->time_to;
        if (isset($request->comment)) $item->comment = $request->comment;
        $item->is_time_selected = ($request->is_time_selected) ? $request->is_time_selected :'0';
        if (isset($request->total_amount)) $item->total_amount = $request->total_amount;

        $item->save();
        if ($item){
            CashDrawersItem::where('cash_drawer_id',$item->id)->delete();
            $cashItems = new CashDrawersItem();
            $cashItems ->cash_drawer_id = $item->id ;
            $cashItems ->cash_one = $request->cash_one ;
            $cashItems ->coin_point_z_one = $request->coin_point_z_one ;
            $cashItems ->cash_five = $request->cash_five ;
            $cashItems ->coin_point_z_five = $request->coin_point_z_five ;
            $cashItems ->cash_ten = $request->cash_ten ;
            $cashItems ->coin_point_one = $request->coin_point_one ;
            $cashItems ->cash_twenty = $request->cash_twenty ;
            $cashItems ->coin_point_two_five = $request->coin_point_two_five ;
            $cashItems ->cash_fifty = $request->cash_fifty ;
            $cashItems ->coin_point_five = $request->coin_point_five ;
            $cashItems ->cash_hundred = $request->cash_hundred ;
            $cashItems ->coin_one = $request->coin_one ;
            $cashItems ->total_cash = $request->total_cash ;
            $cashItems ->total_coins = $request->total_coins ;
            $cashItems->save();
        }
        return $item;
    }
    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
