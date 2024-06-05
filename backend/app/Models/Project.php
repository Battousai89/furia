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
 * @property int $user_id
 * @property string $name
 * @property string $preview_text
 * @property string $description
 * @property string $preview_picture
 * @property string $detail_picture
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereUserId($value)
 * @method static Builder|Project whereName($value)
 * @method static Builder|Project wherePreviewText($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project wherePreviewPicture($value)
 * @method static Builder|Project whereDetailPicture($value)
 */
class Project extends Model
{
    use HasFactory;

    /**
     * Поля сущности
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
     * Связь с владельцем проекта
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с ролями проекта
     *
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(ProjectRole::class);
    }

    /**
     * Связь с участниками проекта
     *
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(ProjectMember::class);
    }

    /**
     * Связь с постами проекта
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(ProjectPost::class);
    }

    /**
     * Связь с чатами проекта
     *
     * @return HasMany
     */
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    #endregion
}
