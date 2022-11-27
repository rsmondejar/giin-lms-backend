<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
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

    public static array $rules = [
        'business_name' => 'required|unique:businesses|max:60',
        'address' => 'required',
        'city' => 'required|max:60',
        'postal_code' => 'required|max:10',
        'country' => 'required|max:60',
        'phone' => 'required|max:20',
        'email' => 'required|email|max:100',
        'website' => 'max:100|nullable',
        'logo' => 'max:255|nullable'
    ];

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

}
