<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPointsLog extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];
    protected $table = 'loyalty_points_log';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function userable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function performer()
    {
        return $this->belongsTo(User::class, 'performed_by','id');
    }

    /**
     * @return mixed
     */
    public function performerName()
    {
        return $this->performer->name;
    }

    /**
     * @param $userable
     * @param $balance
     * @param null $comment
     * @param null $description
     * @param null $performedBy
     * @param null $ticketId
     * @return mixed
     */
    public static function createNew($userAble, $balance, $comment = null, $description = null, $performedBy = null, $ticketId = null)
    {
        $prevBalance = $userAble->loyalty_points_balance;
        $adjustment = $balance - $prevBalance;

        $lP = $userAble->loyaltyLog()->create([
            'adjustment' => $adjustment,
            'balance' => $balance,
            'ticket_id' => $ticketId,
            'comment' => $comment,
            // 'description' => $description ?? 'Manually ' . (int) $adjustment < 0 ? 'decreased' : 'increased' . ' by ' . abs($adjustment),
            'description' => $description ?? $adjustment < 0 ? 'Decreased by ' . abs($adjustment) :'Increased by ' . abs($adjustment),
            'performed_by' => $performedBy ?? lgUId(),
        ]);

        $userAble->loyalty_points_balance = $balance;
        $userAble->save();
        return $lP;
    }
}
