<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CashDrawerItem extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];

}
