<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProjectMember
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property int $project_role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ProjectMember newModelQuery()
 * @method static Builder|ProjectMember newQuery()
 * @method static Builder|ProjectMember query()
 * @method static Builder|ProjectMember whereId($value)
 * @method static Builder|ProjectMember whereUserId($value)
 * @method static Builder|ProjectMember whereProjectId($value)
 * @method static Builder|ProjectMember whereProjectRoleId($value)
 */
class ProjectMember extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    #region relations

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(ProjectRole::class, 'project_role_id');
    }

    #endregion
}
