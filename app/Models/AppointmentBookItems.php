<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AppointmentBookItems extends Model
{
    use HasFactory;
    use ModelTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];
    protected $table = 'appointment_books_items';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function serviceitemable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }





}
