<?php

namespace App\Http\Controllers;

use App\Models\AppointmentBook;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return response()->json([
            'status' => true,
            'html' => view($this->view_path . '.partials.schedule_details_modal')->with(compact('appt'))->render()
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
}
