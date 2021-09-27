<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AppointmentBook extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];

    public $rules =
        [
        ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'appointment_book_id');
    }

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request, $new = false)
    {
        if (isset($request->branch_id)) $item->branch_id = $request->branch_id;
        if (isset($request->client_id)) $item->client_id = $request->client_id;
        if (isset($request->activity_date)) $item->activity_date = $request->activity_date;
        if (isset($request->notes)) $item->notes = $request->notes;
        if (isset($request->status)) $item->status = $request->status;
        $item->created_by = Auth::user()->id ?? 0;

        $item->save();
        if ($new) {
            $item->appointments()->create([
                'start_time' => $request->start,
                'duration' => getMinutesDifference($request->start, $request->end)
            ]);
        } else {
            $item->appointments()->delete();
            if (isset($request->services)) {
                $timeStart = date('H:i:s', strtotime($request->time_start));
                for ($count = 0; $count < count($request->services); $count++) {
                    $currentService = $request->services[$count];
                    $service = Service::find($currentService);
                    $item->appointments()->create([
                        'service_id' => $currentService,
                        'start_time' => $timeStart,
                        'duration' => isset($request->minutes[$currentService]) ? $request->minutes[$currentService] : $service->minutes,
                        'quantity' => isset($request->quantity[$currentService]) ? $request->quantity[$currentService] : 0,
                        'price' => isset($request->price[$currentService]) ? $request->price[$currentService] : $service->price,
                    ]);
                    if (isset($request->basic_form)) {
                        $timeStart = date("H:i:s", strtotime('+' . $service->minutes . ' minutes', strtotime($timeStart)));
                    }
                }
            }
        }
        return $item;
    }
}
