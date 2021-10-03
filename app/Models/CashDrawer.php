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
        if (isset($request->is_time_selected)) $item->is_time_selected = $request->is_time_selected;
        if (isset($request->total_amount)) $item->total_amount = $request->total_amount;

        $item->save();
        return $item;
    }
}
