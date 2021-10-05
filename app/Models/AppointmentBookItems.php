<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentBookItems extends Model
{
    use HasFactory;
    use ModelTrait;

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
