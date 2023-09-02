<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 *
 * @property string $id
 * @property float $score
 * @property string $representative_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property-read Representative $representative
 */
class Elo extends Model
{
    use HasFactory;
    use HasTimestamps;
    use HasUuids;

    protected $table = 'elo';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function representative(): BelongsTo
    {
        return $this->belongsTo(Representative::class);
    }
}
