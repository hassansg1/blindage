<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


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


    ////... Actions...................
    const OPENED = 0;
    const TIMEBLOCK = 1;
    const CLOSED = 2;
    const NOSHOW = 3;
    const CANCELED = 4;
    const VOIDED = 5;
    const CHECKIN = 6;
    const CHECKOUT = 7;
    const WAITLIST = 8;

    ///.............Confirmation Status Flag

    const PHONE_DIRECT = 1;
    const PHONE_ANSWER_MACHINE = 2;
    const IN_PERSON = 3;
    const EMAIL = 4;
    ////............................

    const UPCOMMING_APPT = 9;
    const PREVIOUS_SERVICES = 10;
    const PURCHASED_PRODUCT = 11;
    const OTHER_PURCHASES = 12;



    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getStatusAttribute()
    {
        switch ($this->status_flag) {

            case AppointmentBook::TIMEBLOCK:
                return 'TIMEBLOCK';
                break;
            case AppointmentBook::CLOSED:
                return 'CLOSED';
                break;
            case AppointmentBook::NOSHOW:
                return 'NOSHOW';
                break;
            case AppointmentBook::CANCELED:
                return 'CANCELED';
                break;
            case AppointmentBook::VOIDED:
                return 'VOIDED';
                break;
            case AppointmentBook::CHECKIN:
                return 'CHECKIN';
                break;
            case AppointmentBook::CHECKOUT:
                return 'CLOSED/CHECKOUT';
                break;

             case AppointmentBook::OPENED:
                return 'OPENED';
                break;
        }

    }

    public function getConfirmationStatusAttribute()
    {
        switch ($this->confirmation_status_flag) {

            case AppointmentBook::PHONE_DIRECT:
                return 'Phone ( Direct )';
                break;
            case AppointmentBook::PHONE_ANSWER_MACHINE:
                return 'Phone ( Answer Machine )';
                break;
            case AppointmentBook::IN_PERSON:
                return 'In-Person';
                break;
            case AppointmentBook::EMAIL:
                return 'E-mail';
                break;

        }

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

        $image = $request->file('file');
        if($image) {
            $this->addFiles($image,$request);
            return $item;
        }
        $clientNotes = $request->clientNotes;
        if($clientNotes) {
            $this->addClientNotes($clientNotes,$request);
            return $item;
        }
        // dd($request->all());
        if (isset($request->branch_id)) $item->branch_id = $request->branch_id;
        if (isset($request->client_id)) $item->client_id = $request->client_id; else  $item->client_id = null;
        if (isset($request->activity_date)) $item->activity_date = $request->activity_date;
        if (isset($request->notes)) $item->notes = $request->notes;
        if (isset($request->status)) $item->status = $request->status;
        if (isset($request->status_flag)) $item->status_flag = $request->status_flag;
        if (isset($request->appointment_type_id)) $item->appointment_type_id = $request->appointment_type_id;
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
            $item->appointmentBookItems()->update(['deleted_by_id' => Auth::id()]);
            $item->appointmentBookItems()->delete();
            if (isset($request->services)) {
                // $timeStart = date('H:i:s', strtotime($request->time_start));
                for ($count = 0; $count < count($request->services); $count++) {
                    $currentService = $request->services[$count];
                    $service = Service::find($currentService);
                    if (isset($request->time_start[$currentService])) {
                        $timeStart = date("H:i:s",strtotime($request->time_start[$currentService]));
                    } else {
                        $timeStart = date("H:i:s",strtotime($request->time_start[0]));
                    }
                    $item->appointments()->create([
                        'service_id' => $currentService,
                        'employee_type_id' => isset($request->employee_type_id[$currentService]) ? $request->employee_type_id[$currentService] : null,
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
                for ($count = 0; $count < count($request['products']); $count++) {
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
                for ($count = 0; $count < count($request['packages']); $count++) {
                    $apptBookItem = new AppointmentBookItems();
                    $apptBookItem->appointment_book_id = $request['appointment_book_id'];
                    $apptBookItem->serviceitemable_id = $request['packages'][$count];
                    $apptBookItem->quantity = $request['quantity']['packages'][$request['packages'][$count]];
                    $apptBookItem->price = $request['price']['packages'][$request['packages'][$count]];

                    $product_Obj = Package::find($request['packages'][$count]);
                    $product_Obj->appointmentBookItem()->save($apptBookItem);
                }
            }
            if ($request->client_id) {
                if (isset($request->mobile_no)) {
                    Client::where('id',$request->client_id)->update(['mobile_no'=>$request->mobile_no]);
            }
            if (isset($request->clientEmail)) {
                Client::where('id',$request->client_id)->update(['email'=>$request->clientEmail]);
            }

            }

        }
        return $item;
    }

    public function addFiles($image, $request){
        $imageName = $image->getClientOriginalName();
        $name = time() . $imageName;
        $image->move(public_path('images/files'), $name);

        $imageUpload = new File();
        $imageUpload->filesable_type = "App\Models\AppointmentBook";
        $imageUpload->filesable_id = $request->appointment_book_id;
        $imageUpload->filename = $name;
        $imageUpload->save();
        return true;

    }
    public function addClientNotes($note, $request){
        $imageUpload = new Notes();
        $imageUpload->notesable_type = "App\Models\AppointmentBook";
        $imageUpload->notesable_id = $request->appointment_book_id;
        $imageUpload->notes_content = $note;
        $imageUpload->created_by = Auth::id();
        $imageUpload->save();
        return true;

    }
    public function saveFormData_create_new_schedule($item, $request, $new = false)
    {

        if (isset($request->create_new_branch_id)) $item->branch_id = $request->create_new_branch_id;
        if (isset($request->create_new_client_id)) $item->client_id = $request->create_new_client_id;
        if (isset($request->create_new_activity_date)) $item->activity_date = $request->create_new_activity_date;
        if (isset($request->create_new_appointment_note)) $item->notes = $request->create_new_appointment_note;
          if (isset($request->create_new_appointment_type_id)) $item->appointment_type_id = $request->create_new_appointment_type_id;
        $item->created_by = Auth::user()->id ?? 0;

        if ($item->save())
        {
            if (isset($request->services)) {
                for ($count = 0; $count < count($request->services); $count++) {
                    $currentService = $request->services[$count];
                    $service = Service::find($currentService);
                    $timeStart = date("H:i:s",strtotime($request->create_new_time_start));

                    $item->appointments()->create([
                        'appointment_book_id'=> $item->id,
                        'service_id' => $currentService,
                        'employee_type_id' => isset($request->employee_type_id[$currentService]) ? $request->employee_type_id[$currentService] : null,
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
                for ($count = 0; $count < count($request['products']); $count++) {
                    $apptBookItem = new AppointmentBookItems();
                    $apptBookItem->appointment_book_id = $item->id;
                    $apptBookItem->serviceitemable_id = $request['products'][$count];
                    $apptBookItem->quantity = $request['quantity']['products'][$request['products'][$count]];
                    $apptBookItem->price = $request['price']['products'][$request['products'][$count]];

                    $product_Obj = Product::find($request['products'][$count]);
                    $product_Obj->appointmentBookItem()->save($apptBookItem);
                }
            }
            if (isset($request->packages)) {
                for ($count = 0; $count < count($request['packages']); $count++) {
                    $apptBookItem = new AppointmentBookItems();
                    $apptBookItem->appointment_book_id = $item->id;
                    $apptBookItem->serviceitemable_id = $request['packages'][$count];
                    $apptBookItem->quantity = $request['quantity']['packages'][$request['packages'][$count]];
                    $apptBookItem->price = $request['price']['packages'][$request['packages'][$count]];

                    $product_Obj = Package::find($request['packages'][$count]);
                    $product_Obj->appointmentBookItem()->save($apptBookItem);
                }
            }
        }
        else
        {
            return false;
        }

        return true;
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

    public function cancelAppointment($request)
    {

        $apptBook = AppointmentBook::find($request->appointment);
        $apptBook->mark_no_show = isset($request->mark_no_show)?1:0;
        $apptBook->reason = isset($request->reason_for_cancelation)&& $request->reason_for_cancelation!=null?$request->reason_for_cancelation:0;
        $apptBook->status_flag = AppointmentBook::CANCELED;
        if($apptBook->save())
        {
            return true;
        }
        return false;
    }


    public function appointmentbook_listing($limit, $start, $order, $dir,$branch_id=null,$today = 0 ,$status_flag = null , $dateRange = null , $search = false) {
        $today_date =  date('Y-m-d');
        $result = AppointmentBook::offset($start);
        if ($search) {
            $result->orWhere('id', 'LIKE', "%{$search}%");
            $result->orwhereHas('client', function ($query) use ($search){
                $query->where('last_name', 'like', '%'.$search.'%');
                $query->orWhere('first_name', 'like', '%'.$search.'%');
            });

        }
        if($branch_id!=null && $branch_id!="")
        {
            $result->where('branch_id', '=',$branch_id);
        }
        if($status_flag != null)
        {
            $result->where('status_flag', '=',$status_flag);

        }
        if($today == 1 || $today=='1')
        {
            $result->where('activity_date', '=',$today_date );
        }
        else if($dateRange !=null)
        {
            $explode = explode("-",$dateRange);
            $startDate = date('Y-m-d',strtotime($explode[0]));
            $endDate = date('Y-m-d',strtotime($explode[1]));

            $result->whereBetween('activity_date', [$startDate, $endDate]);
        }

        $result->limit($limit);
        $result->orderBy($order, $dir);
        return $result->get();
    }

    public function appointmentbook_count($search = false ,$branch_id=null ,$today = 0 ,$status_flag = null , $dateRange = null) {

        $today_date =  date('Y-m-d');
        $result = AppointmentBook::select();
        if ($search) {
            $result->orWhere('id', 'LIKE', "%{$search}%");
            $result->orwhereHas('client', function ($query) use ($search){
                $query->where('last_name', 'like', '%'.$search.'%');
                $query->orWhere('first_name', 'like', '%'.$search.'%');
            });
        }
        if($branch_id!=null && $branch_id!="")
        {
            $result->where('branch_id', '=',$branch_id);
        }

        if($status_flag != null)
        {
            $result->where('status_flag', '=',$status_flag);

        }

        if($today == 1 || $today=='1')
        {
            $result->where('activity_date', '=',$today_date);
        }
        else if($dateRange !=null)
        {
            $explode = explode("-",$dateRange);
            $startDate = date('Y-m-d',strtotime($explode[0]));
            $endDate = date('Y-m-d',strtotime($explode[1]));

            $result->whereBetween('activity_date', [$startDate, $endDate]);

        }

        return $result->count();
    }

    public function appointmentBookImages(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(File::class, 'filesable')->orderBy('id','desc');
    }
    public function appointmentBookNotes(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Notes::class, 'notesable')->orderBy('id','desc');
    }

    public function appointmentType()
    {
        return $this->belongsTo(AppointmentType::class, 'appointment_type_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


}
