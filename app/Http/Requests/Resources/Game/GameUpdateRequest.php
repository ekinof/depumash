<?php

declare(strict_types=1);

namespace App\Http\Requests\Resources\Game;

use Illuminate\Foundation\Http\FormRequest;

class GameUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'winner' => ['required', 'uuid'],
        ];
    }
}
