<?php

namespace App\Http\Controllers;

use App\Models\AppointmentBook;
use App\Models\Notes;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Product;
use App\Models\Package;
use Illuminate\Support\Facades\View;

class AjaxAppointmentBookController extends Controller
{
    //

    private $view_path = 'appointment_book';

    public function getAppointmentModal(Request $request)
    {
        $date = calenderDateDbFormatter($request->start);
        $start = calenderTimeFormatter($request->start);
        $end = calenderTimeFormatter($request->end);

        $request->activity_date = calenderDateDbFormatter($request->start);

        $request->start = $start;
        $request->end = $end;
        $apptBook = AppointmentBook::find($request->id);

        $appt = app(AppointmentBook::class)->saveFormData($apptBook, $request, true);

        return response()->json([
            'status' => true,
            'html' => view($this->view_path . '.partials.create_modal')->with(compact('date', 'start', 'end', 'appt'))->render()
        ]);
    }

    public function getAppointmentDetailModal(Request $request)
    {
        $appt = AppointmentBook::find($request->id);
        $start = $request->start_time;
        $end = $request->end_time;
        $duration = getMinutesDifference($start, $end);
        return response()->json([
            'status' => true,
            'html' => view($this->view_path . '.partials.schedule_details_modal')->with(compact('appt','start','end','duration'))->render()
        ]);
    }

    public function updateAppointment(Request $request)
    {
        $date = calenderDateFormatter($request->start);
        $start = calenderTimeFormatter($request->start);
        $end = calenderTimeFormatter($request->end);

        $request->activity_date = calenderDateDbFormatter($request->start);

        $request->start = $start;
        $request->end = $end;

        app(AppointmentBook::class)->saveFormData(new AppointmentBook(), $request, true);

        return response()->json([
            'status' => true,
            'html' => view($this->view_path . '.partials.create_modal')->with(compact('date', 'start', 'end'))->render()
        ]);
    }

    public function getItemsDataView(Request $request)
    {

        $start = isset($request->start)?$request->start:'';
        $end = isset($request->end)?$request->end:'';
        $duration = isset($request->duration)?$request->duration:'';

        $modal_name = explode('??', $request->value);
        $classObj = '\\App\\Models\\'.$modal_name[0];
        $getData = $classObj::find($modal_name[1]);

        return response()->json([
            'status' => true,
            'modal_name' => $modal_name[0],
            'html' => view($this->view_path . '.partials._item_'.$modal_name[0])->with(compact('getData','start','end','duration'))->render()
        ]);

    }

    public function appointment_status_update(Request $request)
    {
        $result = AppointmentBook::find($request->appointbook_id);
        if($result !=null)
        {
            if($request->value == AppointmentBook::CHECKIN)
            {
                $result->checked_in = date('Y-m-d H:i:s');

            }
            if($request->value == AppointmentBook::CHECKOUT)
            {
                $result->checked_out = date('Y-m-d H:i:s');

            }
            $result->status_flag = $request->value;


            $result->save();
            return response()->json([
            'status' => true,
            'html' => view('appointment_book.partials._appointmentView')->with(['data' => $result])->render()]);

        }
        else
        {
            return response()->json([
            'status' => false
            ]);
        }

        // dd($request->all());
    }
    
    public function appointment_confirmation_status_update(Request $request)
    {
        $result = AppointmentBook::find($request->appointbook_id);
        if($result !=null)
        {
            
            $result->confirmation_status_flag = $request->value;
            $result->save();
            return response()->json([
            'status' => true]);
        }
        else
        {
            return response()->json([
            'status' => false
            ]);
        }

        // dd($request->all());
    }


    public function addNewClient(Request $request){
        $item = new Client();
         $item->first_name = $request->first_name;
         $item->last_name = $request->last_name;
         $item->category = $request->category;
         $item->mobile_no = $request->mobile_no;
         $item->alt_mobile_no = $request->alt_mobile_no;
         $item->dob = $request->dob;
         $item->email = $request->email;
         $item->active = $request->active;
         $item->appointment_email = $request->appointment_email;
         $item->marketing_mail = $request->marketing_mail;
         $item->appointment_message = $request->appointment_message;
         $item->active = 1;
         $item->save();
        $clients = View::make('appointment_book.tabs.rows._clients_dropDown')->render();
        return response()->json([
            'status' => true,
            'clients' => $clients,
        ]);    
    }

    public function deleteAppointmentNote(Request $request)
    {
        if(Notes::find($request->note_id)->delete())
        {
            return response()->json(['status' => true]);  
        }
        return response()->json(['status' => false]); 

    }

    public function addClientImage(Request $request)
    {
        // dd($request->all());
        $pathName = 'clientImages';
        
        if (!empty($request->old_image)) {
            $path = public_path() . '/' . $pathName . '/' . $request->old_image;
            if (file_exists($path)) 
            {
            
                unlink($path);
            }
        }

        $image = $request->file('user_profile');
        $input = 'user_profile'.date('Ymd').time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/' . $pathName);
        $image->move($destinationPath, $input);

        $client = Client::find($request->user_id);
        $client->image = $input;
        if($client->save())
        {
            return response()->json(['status' => true,'newFileName'=>$input]); 

        }
        
        return response()->json(['status' => false]); 


    }


}
