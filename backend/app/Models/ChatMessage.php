<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\ChatMessage
 *
 * @property int $id
 * @property int $chat_id
 * @property int $chat_member_id
 * @property string $content
 * @property string $files
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ChatMessage newModelQuery()
 * @method static Builder|ChatMessage newQuery()
 * @method static Builder|ChatMessage query()
 * @method static Builder|ChatMessage whereId($value)
 * @method static Builder|ChatMessage whereChatId($value)
 * @method static Builder|ChatMessage whereChatMemberId($value)
 * @method static Builder|ChatMessage whereContent($value)
 * @method static Builder|ChatMessage whereFiles($value)
 */
class ChatMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'files',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    #region relations

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(ChatMember::class, 'chat_member_id');
    }

    #endregion
}
