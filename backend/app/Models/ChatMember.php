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
 * @property boolean $owner
 * @property boolean $write
 * @property boolean $react
 * @property boolean $audio
 * @property boolean $video
 * @property boolean $files
 * @property boolean $invite_members
 * @property boolean $accept_members
 * @property boolean $remove_members
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ChatMember newModelQuery()
 * @method static Builder|ChatMember newQuery()
 * @method static Builder|ChatMember query()
 * @method static Builder|ChatMember whereId($value)
 * @method static Builder|ChatMember whereChatId($value)
 * @method static Builder|ChatMember whereUserId($value)
 * @method static Builder|ChatMember whereOwner($value)
 * @method static Builder|ChatMember whereWrite($value)
 * @method static Builder|ChatMember whereReact($value)
 * @method static Builder|ChatMember whereAudio($value)
 * @method static Builder|ChatMember whereVideo($value)
 * @method static Builder|ChatMember whereFiles($value)
 * @method static Builder|ChatMember whereInviteMembers($value)
 * @method static Builder|ChatMember whereAcceptMembers($value)
 * @method static Builder|ChatMember whereRemoveMembers($value)
 */
class ChatMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner',
        'write',
        'react',
        'audio',
        'video',
        'files',
        'invite_members',
        'accept_members',
        'remove_members'
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    #endregion
}
