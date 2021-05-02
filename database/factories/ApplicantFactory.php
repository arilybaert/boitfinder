<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => "Hey, we are a you frsh band thats looking for a new opportunity. Since your ad closely resambles our style we though to ourselfs why not take shot. We're looking forward to your response",
        ];
    }
}
