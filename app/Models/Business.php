<?php

namespace App\Models;

use Database\Factories\BusinessFactory;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;

/**
 * App\Models\Business
 *
 * @OA\Schema (
 *      schema="Business",
 *      required={"id","business_name","address","city","postal_code","country","phone","email"},
 *      @OA\Property(
 *          property="id",
 *          description="",
 *          readOnly=true,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="business_name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="address",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="city",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="postal_code",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="country",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="phone",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="website",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="logo",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
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
 * @property string $business_name
 * @property string $address
 * @property string $city
 * @property string $postal_code
 * @property string $country
 * @property string $phone
 * @property string $email
 * @property string|null $website
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read string $logo_folder_path
 * @property-read string $logo_path
 * @method static BusinessFactory factory(...$parameters)
 * @method static Builder|Business newModelQuery()
 * @method static Builder|Business newQuery()
 * @method static \Illuminate\Database\Query\Builder|Business onlyTrashed()
 * @method static Builder|Business query()
 * @method static Builder|Business whereAddress($value)
 * @method static Builder|Business whereBusinessName($value)
 * @method static Builder|Business whereCity($value)
 * @method static Builder|Business whereCountry($value)
 * @method static Builder|Business whereCreatedAt($value)
 * @method static Builder|Business whereDeletedAt($value)
 * @method static Builder|Business whereEmail($value)
 * @method static Builder|Business whereId($value)
 * @method static Builder|Business whereLogo($value)
 * @method static Builder|Business wherePhone($value)
 * @method static Builder|Business wherePostalCode($value)
 * @method static Builder|Business whereUpdatedAt($value)
 * @method static Builder|Business whereWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|Business withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Business withoutTrashed()
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
class Business extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'businesses';

    public $fillable = [
        'business_name',
        'address',
        'city',
        'postal_code',
        'country',
        'phone',
        'email',
        'website',
        'logo'
    ];

    protected $casts = [
        'id' => 'integer',
        'business_name' => 'string',
        'address' => 'string',
        'city' => 'string',
        'postal_code' => 'string',
        'country' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'website' => 'string',
        'logo' => 'string'
    ];

    public $appends = ['logo_path', 'logo_folder_path'];

    /**
     * Set Phone Attribute.
     * @param string $value
     * @return void
     */
    public function setPhoneAttribute(string $value): void
    {
        // Remove whitespaces.
        $this->attributes['phone'] = str_replace(' ', '', $value);
    }

    /**
     * Get Logo Path
     * @return string Logo Path
     */
    #[Pure] public function getLogoPathAttribute(): string
    {
        try {
            $image = $this->attributes['logo'];
        } catch (Exception $e) {
            $image = null;
        }

        if (null !== $image) {
            return $this->getLogoFolderPathAttribute() . $image;
        } else {
            return "/img/no-image.png";
        }
    }

    /**
     * Get Logo Folder Path
     * @return string Logo Folder Path
     */
    public function getLogoFolderPathAttribute(): string
    {
        return "/files/";
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
