<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CashDrawersItem extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];
    public function cashDrawer(){
        return $this->belongsTo(CashDrawer::class, 'cash_drawer_id');
    }
}
