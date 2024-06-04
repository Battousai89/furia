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
     * The attributes that are mass assignable.
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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    #region relations

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roles(): HasMany
    {
        return $this->hasMany(ProjectRole::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(ProjectPost::class);
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    #endregion
}
