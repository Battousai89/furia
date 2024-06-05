<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProjectRole
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property boolean $is_can_create_posts
 * @property boolean $is_can_edit_posts
 * @property boolean $is_can_remove_posts
 * @property boolean $is_can_create_chats
 * @property boolean $is_can_invite_members
 * @property boolean $is_can_accept_members
 * @property boolean $is_can_remove_members
 * @property boolean $is_can_change_project_name
 * @property boolean $is_can_change_project_preview
 * @property boolean $is_can_change_project_description
 * @property boolean $is_can_change_project_preview_picture
 * @property boolean $is_can_change_project_detail_picture
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ProjectRole newModelQuery()
 * @method static Builder|ProjectRole newQuery()
 * @method static Builder|ProjectRole query()
 * @method static Builder|ProjectRole whereId($value)
 * @method static Builder|ProjectRole whereProjectId($value)
 * @method static Builder|ProjectRole whereName($value)
 * @method static Builder|ProjectRole whereIsCanCreatePosts($value)
 * @method static Builder|ProjectRole whereIsCanEditPosts($value)
 * @method static Builder|ProjectRole whereIsCanRemovePosts($value)
 * @method static Builder|ProjectRole whereIsCanCreateChats($value)
 * @method static Builder|ProjectRole whereIsCanInviteMembers($value)
 * @method static Builder|ProjectRole whereIsCanAcceptMembers($value)
 * @method static Builder|ProjectRole whereIsCanRemoveMembers($value)
 * @method static Builder|ProjectRole whereIsCanChangeProjectName($value)
 * @method static Builder|ProjectRole whereIsCanChangePreview($value)
 * @method static Builder|ProjectRole whereIsCanChangeDescription($value)
 * @method static Builder|ProjectRole whereIsCanChangePreviewPicture($value)
 * @method static Builder|ProjectRole whereIsCanChangeDetailPicture($value)
 */
class ProjectRole extends Model
{
    use HasFactory;

    /**
     * Поля сущности
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_can_create_posts',
        'is_can_edit_posts',
        'is_can_remove_posts',
        'is_can_create_chats',
        'is_can_invite_members',
        'is_can_accept_members',
        'is_can_remove_members',
        'is_can_change_project_name',
        'is_can_change_project_preview',
        'is_can_change_project_description',
        'is_can_change_project_preview_picture',
        'is_can_change_project_detail_picture'
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
     * Свящь с участниками проекта
     *
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(ProjectMember::class, 'project_role_id');
    }

    #endregion
}
