<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItems extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];
    protected $table = 'package_items';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function packageitemable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    /**
     * @return mixed
     */
    public function packageName()
    {
        return $this->performer->name;
    }

    /**
     * @param $packageAble
     * @param double $quantity
     * @return mixed
     */
    public static function createNew($packageAble, $quantity = 0)
    {
        return $packageAble->packageItem()->create([
            'quantity' => $quantity,
        ]);
    }
}
