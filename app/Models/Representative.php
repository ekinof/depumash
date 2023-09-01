<?php

namespace App\Models;

use App\Enum\GenderEnum;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;

/**
 * @mixin Eloquent
 */
class Representative extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    use HasTimestamps;

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
}
