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
    public static function parse()
    {
        $data = Appointment::with(['appointmentBook.client', 'service'])->whereNotNull('start_time')->whereNotNull('duration')->get();

        return $data;
    }

}