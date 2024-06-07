<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Chat
 *
 * @property int $id
 * @property ?int $project_id
 * @property string $title
 * @property ?string $description
 * @property ?string $picture
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Chat newModelQuery()
 * @method static Builder|Chat newQuery()
 * @method static Builder|Chat query()
 * @method static Builder|Chat whereId($value)
 * @method static Builder|Chat whereProjectId($value)
 * @method static Builder|Chat whereTitle($value)
 * @method static Builder|Chat whereDescription($value)
 * @method static Builder|Chat wherePicture($value)
 */
class Chat extends Model
{
    use HasFactory;

    /**
     * Поля сущности
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'picture'
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
     * Связь с участниками чата
     *
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(ChatMember::class);
    }

    /**
     * Связь с сообщениями чата
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    #endregion
}
