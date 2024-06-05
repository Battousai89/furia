<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\PostComment
 *
 * @property int $id
 * @property int $project_post_id
 * @property int $user_id
 * @property string $content
 * @property int $post_comment_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PostComment newModelQuery()
 * @method static Builder|PostComment newQuery()
 * @method static Builder|PostComment query()
 * @method static Builder|PostComment whereId($value)
 * @method static Builder|PostComment whereProjectPostId($value)
 * @method static Builder|PostComment whereUserId($value)
 * @method static Builder|PostComment whereContent($value)
 * @method static Builder|PostComment wherePostCommentId($value)
 */
class PostComment extends Model
{
    use HasFactory;

    /**
     * Поля сущности
     *
     * @var array
     */
    protected $fillable = [
        'content',
    ];
    /**
     *
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
     * Связь с постом
     *
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(ProjectPost::class, 'project_post_id');
    }

    /**
     * Связь с автором комментария
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с родительским комментарием
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'post_comment_id');
    }

    /**
     * Связь с дочерними комментариями
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class);
    }

    #endregion
}
