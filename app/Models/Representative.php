<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\GenderEnum;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Eloquent
 *
 * @property string $id
 * @property string $external_id
 * @property string $first_name
 * @property string $last_name
 * @property GenderEnum $gender
 * @property DateTime $birthday
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $deleted_at
 * @property-read Elo $elo
 */
class Representative extends Model
{
    use HasFactory;
    use HasTimestamps;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'representative';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'external_id',
    ];

    protected $casts = [
        'birthday' => 'datetime',
        'gender' => GenderEnum::class,
        'deleted_at' => 'datetime',
    ];

    public function elo(): HasOne
    {
        return $this->hasOne(Elo::class);
    }
}
