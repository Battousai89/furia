<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;


/**
 * App\Models\Project
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $title
 * @property string $preview_text
 * @property string $description
 * @property ?string $preview_picture
 * @property ?string $detail_picture
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ProjectPost newModelQuery()
 * @method static Builder|ProjectPost newQuery()
 * @method static Builder|ProjectPost query()
 * @method static Builder|ProjectPost whereId($value)
 * @method static Builder|ProjectPost whereProjectId($value)
 * @method static Builder|ProjectPost whereUserId($value)
 * @method static Builder|ProjectPost whereTitle($value)
 * @method static Builder|ProjectPost wherePreviewText($value)
 * @method static Builder|ProjectPost whereDescription($value)
 * @method static Builder|ProjectPost wherePreviewPicture($value)
 * @method static Builder|ProjectPost whereDetailPicture($value)
 */
class ProjectPost extends Model
{
    use HasFactory;

    /**
     * Поля сущности
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'preview_text',
        'description',
        'preview_picture',
        'detail_picture',
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
     * Связь с проектом
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Связь с автором поста
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с комментариями поста
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    #endregion
}
