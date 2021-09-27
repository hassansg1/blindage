<?php

namespace App\Models;

use App\Http\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $guarded = [];
    protected $table = 'notes';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function notesable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return mixed
     */
    public function creatorName()
    {
        return $this->creator->name;
    }

    /**
     * @param $notesAble
     * @param $content
     * @param null $createdBy
     * @return mixed
     */
    public static function createNew($notesAble, $content, $createdBy = null)
    {

        $item = $notesAble->notes()->create();
        self::saveObj($item,$content, $createdBy);

        return $item;
    }

    public static function updateExisting($id, $content, $createdBy = null)
    {
        $item = self::find($id);
        self::saveObj($item,$content, $createdBy);

        return $item;
    }

    public static function saveObj($item, $content, $createdBy = null)
    {
        $item->update([
            'notes_content' => $content,
            'created_by' => $createdBy ?? lgUId(),
        ]);
    }
}
