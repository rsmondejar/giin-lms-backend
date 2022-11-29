<?php

namespace App\Models;

use Database\Factories\RoleFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use OpenApi\Annotations as OA;

/**
 * App\Models\Role
 *
 * @OA\Schema (
 *      schema="Role",
 *      required={"name","guard_name"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="guard_name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static RoleFactory factory(...$parameters)
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereGuardName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Role extends Model
{
    use HasFactory;

    public $table = 'roles';

    public $fillable = [
        'name',
        'guard_name'
    ];

    protected $casts = [
        'name' => 'string',
        'guard_name' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string',
        'guard_name' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }
}
