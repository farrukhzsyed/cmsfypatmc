<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use File;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    // protected $project = Project::class;
    // protected $client = Client::class;
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        File::makeDirectory(storage_path('public/payment evidence files'), 0777, true, true);

        return [
            'projectId' => \App\Models\Project::inRandomOrder()->first()->id, 
            'issuedTo' => \App\Models\Client::inRandomOrder()->first()->id, 
            'amountToPay' => $this->faker->biasedNumberBetween(100, 1000), 
            'dueDate' => $this->faker->date(), 
            'paymentEvidence' => \Illuminate\Http\UploadedFile::fake()->create('evidence.pdf')->store('public/payment evidence files'), 
            'paymentDate' => $this->faker->date, 
            'isPayEvidenceApproved' => $this->faker->randomElement([0, 1]),
        ];
    }
}