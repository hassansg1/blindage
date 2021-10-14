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

    public function appointmentBookItems()
    {
        return $this->hasMany(AppointmentBookItems::class, 'appointment_book_id');
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
            $item->appointmentBookItems()->delete();
            if (isset($request->services)) {
                    // $timeStart = date('H:i:s', strtotime($request->time_start));
                for ($count = 0; $count < count($request->services); $count++) {
                    $currentService = $request->services[$count];
                    $service = Service::find($currentService);
                    if(isset($request->time_start[$currentService]))
                    {
                        $timeStart = $request->time_start[$currentService];
                    }
                    else
                    {
                        $timeStart = $request->time_start[0];
                    }
                    $item->appointments()->create([
                        'service_id' => $currentService,
                        'employee_type_id'=> isset($request->employee_type_id[$currentService]) ? $request->employee_type_id[$currentService] : null,
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

            if (isset($request->products)) {
                for ($count = 0; $count < count($request['products']); $count++) 
                {
                    $apptBookItem = new AppointmentBookItems();
                    $apptBookItem->appointment_book_id = $request['appointment_book_id'];
                    $apptBookItem->serviceitemable_id = $request['products'][$count];
                    $apptBookItem->quantity = $request['quantity']['products'][$request['products'][$count]];
                    $apptBookItem->price = $request['price']['products'][$request['products'][$count]];

                    $product_Obj = Product::find($request['products'][$count]);
                    $product_Obj->appointmentBookItem()->save($apptBookItem);
                }
            }

            if (isset($request->packages)) {
                for ($count = 0; $count < count($request['packages']); $count++) 
                {
                    $apptBookItem = new AppointmentBookItems();
                    $apptBookItem->appointment_book_id = $request['appointment_book_id'];
                    $apptBookItem->serviceitemable_id = $request['packages'][$count];
                    $apptBookItem->quantity = $request['quantity']['packages'][$request['packages'][$count]];
                    $apptBookItem->price = $request['price']['packages'][$request['packages'][$count]];

                    $product_Obj = Package::find($request['packages'][$count]);
                    $product_Obj->appointmentBookItem()->save($apptBookItem);
                }
            }


            // dd($request->all());

        }
        return $item;
    }
}
