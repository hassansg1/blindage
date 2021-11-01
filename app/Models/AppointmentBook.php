<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class AppointmentBook extends Model
{
    use HasFactory;
    use ModelTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public $rules =
        [
        ];

    const OPENED = 0;
    const TIMEBLOCK = 1;
    const CLOSED = 2;
    const NOSHOW = 3;
    const CANCELED = 4;
    const VOIDED = 5;

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
            $item->appointments()->update(['deleted_by_id'=>Auth::id()]);
            $item->appointments()->delete();
            $item->appointmentBookItems()->update(['deleted_by_id'=>Auth::id()]);
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

    public function deleteAppointment($request)
    {
        // FIrst Delete AppointmentBookItems
        // Second Delete Appointments
        // Third Delete AppointmentBook
        $apptBook = AppointmentBook::find($request->appointment);
        // Delete AppointmentBookItems
        $apptBook->appointmentBookItems()->update(['deleted_by_id'=>Auth::id()]);
        $apptBook->appointmentBookItems->each->delete();  
        //................................
        // Delete Appointments............
        $apptBook->appointments()->update(['deleted_by_id'=>Auth::id()]);
        $apptBook->appointments->each->delete();
        // ................................
        $apptBook->mark_no_show = isset($request->mark_no_show)?1:0;
        $apptBook->reason = isset($request->reason_for_cancelation)&& $request->reason_for_cancelation!=null?$request->reason_for_cancelation:0;
        $apptBook->deleted_by_id = Auth::id();
        $apptBook->save();
        if($apptBook->delete())
        {
            return true;
        }
        return false;
    }




    public function appointmentbook_listing($limit, $start, $order, $dir,$today = 0 ,$search = false) {
        $today_date =  date('Y-m-d');
        $result = AppointmentBook::offset($start);
        if ($search) {
            $result->orWhere('id', 'LIKE', "%{$search}%");
            $result->orwhereHas('client', function ($query) use ($search){
                $query->where('last_name', 'like', '%'.$search.'%');
                $query->orWhere('first_name', 'like', '%'.$search.'%');
            });

        }
        if($today == 1 || $today=='1')
        {
            $result->where('activity_date', '=',$today_date );

        }
        $result->limit($limit);
        $result->orderBy($order, $dir);
        return $result->get();
    }

    public function appointmentbook_count($search = false ,$today = 0) {
        $today_date =  date('Y-m-d');
        $result = AppointmentBook::select();
        if ($search) {
            $result->orWhere('id', 'LIKE', "%{$search}%");
            $result->orwhereHas('client', function ($query) use ($search){
                $query->where('last_name', 'like', '%'.$search.'%');
                $query->orWhere('first_name', 'like', '%'.$search.'%');
            });
        }
        if($today == 1 || $today=='1')
        {
            $result->where('activity_date', '=',$today_date);
        }
        return $result->count();
    }




}
