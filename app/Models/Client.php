<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];

//    public $rules =
//        [
//            'first_name' => 'required | max:255',
//            'last_name' => 'required | max:255',
//        ];

    /**
     * @var string[]
     */
    protected $appends = ['initials', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function loyaltyLog(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(LoyaltyPointsLog::class, 'userable')->orderBy('id','desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(File::class, 'filesable')->orderBy('id','desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Notes::class, 'notesable')->orderBy('id','desc');
    }

    /**
     * @return string
     */
    public function getInitialsAttribute(): string
    {
        return ucfirst(substr($this->first_name, 0, 1)) . ucfirst(substr($this->last_name, 0, 1));
    }

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * @param $value
     */
    public function setCategoryAttribute($value)
    {
        if (!is_numeric($value) || Category::find($value) == null) {
            $value = Category::createNew($value);
        }
        $this->attributes['category'] = $value;
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
        if (isset($request->category)) $item->category = $request->category;
        if (isset($request->mobile_no)) $item->mobile_no = $request->mobile_no;
        if (isset($request->alt_mobile_no)) $item->alt_mobile_no = $request->alt_mobile_no;
        if (isset($request->dob)) $item->dob = $request->dob;
        if (isset($request->email)) $item->email = $request->email;
        if (isset($request->active)) $item->active = $request->active;
        if (isset($request->appointment_email)) $item->appointment_email = $request->appointment_email;
        if (isset($request->marketing_mail)) $item->marketing_mail = $request->marketing_mail;
        if (isset($request->appointment_message)) $item->appointment_message = $request->appointment_message;
        if (isset($request->address_line_1)) $item->address_line_1 = $request->address_line_1;
        if (isset($request->address_line_2)) $item->address_line_2 = $request->address_line_2;
        if (isset($request->city)) $item->city = $request->city;
        if (isset($request->state)) $item->state = $request->state;
        if (isset($request->postal_code)) $item->postal_code = $request->postal_code;
        if (isset($request->referral)) $item->referral = $request->referral;
        if (isset($request->comments)) $item->comments = $request->comments;

        $item->save();
        return $item;
    }
}
