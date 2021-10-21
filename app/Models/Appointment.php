<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class Appointment extends Model
{
    use HasFactory;
    use ModelTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public $rules =
        [
        ];

    protected $appends = ['end_time'];

    public function appointmentBook()
    {
        return $this->belongsTo(AppointmentBook::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_type_id');
    }

    public function getEndTimeAttribute()
    {
        try {
            $endTime = Carbon::createFromFormat('H:i:s', $this->start_time)->addMinutes($this->duration);
        } catch (\Exception $e) {
        }

        return date('H:i:s', strtotime($endTime));
    }
    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->appointment_book_id)) $item->appointment_book_id = $request->appointment_book_id;
        if (isset($request->client_id)) $item->client_id = $request->client_id;
        if (isset($request->activity_date)) $item->activity_date = $request->activity_date;
        if (isset($request->notes)) $item->notes = $request->notes;
        if (isset($request->status)) $item->status = $request->status;
        if (isset($request->created_by)) $item->created_by = $request->created_by;

        $item->save();
        return $item;
    }

















}
