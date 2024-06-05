<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ChatMember
 *
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property boolean $is_owner
 * @property boolean $is_can_write
 * @property boolean $is_can_send_react
 * @property boolean $is_can_send_audio
 * @property boolean $is_can_send_video
 * @property boolean $is_can_send_files
 * @property boolean $is_can_invite_members
 * @property boolean $is_can_accept_members
 * @property boolean $is_can_remove_members
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ChatMember newModelQuery()
 * @method static Builder|ChatMember newQuery()
 * @method static Builder|ChatMember query()
 * @method static Builder|ChatMember whereId($value)
 * @method static Builder|ChatMember whereChatId($value)
 * @method static Builder|ChatMember whereUserId($value)
 * @method static Builder|ChatMember whereIsOwner($value)
 * @method static Builder|ChatMember whereIsCanWrite($value)
 * @method static Builder|ChatMember whereIsCanSendReact($value)
 * @method static Builder|ChatMember whereIsCanSendAudio($value)
 * @method static Builder|ChatMember whereIsCanSendVideo($value)
 * @method static Builder|ChatMember whereIsCanSendFiles($value)
 * @method static Builder|ChatMember whereIsCanInviteMembers($value)
 * @method static Builder|ChatMember whereIsCanAcceptMembers($value)
 * @method static Builder|ChatMember whereIsCanRemoveMembers($value)
 */
class ChatMember extends Model
{
    use HasFactory;

    /**
     * Поля сущности
     *
     * @var array
     */
    protected $fillable = [
        'is_owner',
        'is_can_write',
        'is_can_send_react',
        'is_can_send_audio',
        'is_can_send_video',
        'is_can_send_files',
        'is_can_invite_members',
        'is_can_accept_members',
        'is_can_remove_members'
    ];

    /**
     * Автозаполняемые поля
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    #region relations

    /**
     * Связь с чатом
     *
     * @return BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Связь с пользователем
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с сообщениями в чатах
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    #endregion
}
