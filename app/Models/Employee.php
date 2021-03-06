<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use App\Scopes\EmployeeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $table = 'users';
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new EmployeeScope());
    }

//    public $rules =
//        [
//            'first_name' => 'required | max:255',
//            'last_name' => 'required | max:255',
//            'email' => 'required | max:255',
//        ];

    protected $appends = ['initials'];

    public function getInitialsAttribute()
    {
        return ucfirst(substr($this->first_name,0,1)).ucfirst(substr($this->last_name,0,1));
    }
    public function getFirstAndLastName()
    {
        if(isset($this->first_name) && isset($this->last_name))
        {
            return ucfirst($this->first_name).' '.ucfirst($this->last_name);
        }
    }
    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->first_name)) $item->first_name = $request->first_name;
        if (isset($request->last_name)) $item->last_name = $request->last_name;
        $item->usertype_id = 1;
        if (isset($request->nick_name)) $item->nick_name = $request->nick_name;
        if (isset($request->mobile_no)) $item->mobile_no = $request->mobile_no;
        if (isset($request->alt_mobile_no)) $item->alt_mobile_no = $request->alt_mobile_no;
        if (isset($request->dob)) $item->dob = date('Y-m-d',strtotime($request->dob));
        if (isset($request->email)) $item->email = $request->email;
        if (isset($request->active)) $item->active = $request->active;
        if (isset($request->address_line_1)) $item->address_line_1 = $request->address_line_1;
        if (isset($request->address_line_2)) $item->address_line_2 = $request->address_line_2;
        if (isset($request->city)) $item->city = $request->city;
        if (isset($request->state)) $item->state = $request->state;
        if (isset($request->setup)) $item->setup = $request->setup;
        if (isset($request->postal_code)) $item->postal_code = $request->postal_code;
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $name = time() . $file->getClientOriginalName();
            $destinationPath = public_path('images/employees');
            $file->move($destinationPath, $name);
            if (isset($request->avatar)) $item->avatar = $name;
        }
        $item->save();
        return $item;
    }
}
