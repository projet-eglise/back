<?php

namespace Database\Factories\Mailing;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Src\Domain\Shared\Timestamp;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mailing\MailHistory>
 */
class MailHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'template_id' => 1,
            'from_id' => 1,
            'to_name' => '',
            'to_email' => fake()->safeEmail(),
            'params' => '{}',
            'reply_to' => fake()->safeEmail(),
            'sending_time' => Timestamp::now(),
            'api_response_code' => 200,
            'api_response_message' => 'OK',
        ];
    }
}
