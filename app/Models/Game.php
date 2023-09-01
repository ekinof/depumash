<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Eloquent
 *
 * @property string $id
 * @property string $session_id
 * @property string $first_representative_id
 * @property string $second_representative_id
 * @property-read Representative $firstRepresentative
 * @property-read Representative $secondRepresentative
 */
class Game extends Model
{
    use HasFactory;
    use HasTimestamps;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'game';

    public $incrementing = false;

    protected $keyType = 'string';

    public function firstRepresentative(): BelongsTo
    {
        return $this->belongsTo(Representative::class, 'first_representative_id');
    }

    public function secondRepresentative(): BelongsTo
    {
        return $this->belongsTo(Representative::class, 'second_representative_id');
    }
}
