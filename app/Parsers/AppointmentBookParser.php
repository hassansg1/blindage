<?php
/**
 * Created by PhpStorm.
 * User: Fujistu
 * Date: 9/23/2021
 * Time: 3:47 PM
 */

namespace App\Parsers;


use App\Models\Appointment;

class AppointmentBookParser
{
    public static function parse($branch_id=null)
    {
        $data = Appointment::with(['appointmentBook.client', 'service'])->whereNotNull('start_time')->whereNotNull('duration');
      	if($branch_id!=null)
      	{
       		$data->join('appointment_books', 'appointment_books.id', '=', 'appointments.appointment_book_id')->where('branch_id',$branch_id);
       	}
        return $data->get();
    }

}