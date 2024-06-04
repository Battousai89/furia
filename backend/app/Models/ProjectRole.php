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
 * @property boolean $create_posts
 * @property boolean $edit_posts
 * @property boolean $remove_posts
 * @property boolean $create_chats
 * @property boolean $invite_members
 * @property boolean $accept_members
 * @property boolean $remove_members
 * @property boolean $change_project_name
 * @property boolean $change_project_preview
 * @property boolean $change_project_description
 * @property boolean $change_project_preview_picture
 * @property boolean $change_project_detail_picture
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ProjectRole newModelQuery()
 * @method static Builder|ProjectRole newQuery()
 * @method static Builder|ProjectRole query()
 * @method static Builder|ProjectRole whereId($value)
 * @method static Builder|ProjectRole whereProjectId($value)
 * @method static Builder|ProjectRole whereName($value)
 * @method static Builder|ProjectRole whereCreatePosts($value)
 * @method static Builder|ProjectRole whereEditPosts($value)
 * @method static Builder|ProjectRole whereRemovePosts($value)
 * @method static Builder|ProjectRole whereCreateChats($value)
 * @method static Builder|ProjectRole whereInviteMembers($value)
 * @method static Builder|ProjectRole whereAcceptMembers($value)
 * @method static Builder|ProjectRole whereRemoveMembers($value)
 * @method static Builder|ProjectRole whereChangeProjectName($value)
 * @method static Builder|ProjectRole whereChangePreview($value)
 * @method static Builder|ProjectRole whereChangeDescription($value)
 * @method static Builder|ProjectRole whereChangePreviewPicture($value)
 * @method static Builder|ProjectRole whereChangeDetailPicture($value)
 */
class ProjectRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'create_posts',
        'edit_posts',
        'remove_posts',
        'create_chats',
        'invite_members',
        'accept_members',
        'remove_members',
        'change_project_name',
        'change_project_preview',
        'change_project_description',
        'change_project_preview_picture',
        'change_project_detail_picture'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    #region relations

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(ProjectMember::class, 'project_role_id');
    }

    #endregion
}
