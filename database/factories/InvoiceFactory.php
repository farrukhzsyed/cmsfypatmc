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
        $type = $this->faker->randomElement(['App\Models\Accountant', 'App\Models\Admin']);
        if($type == 'App\Models\Accountant')
            $user_id = \App\Models\Accountant::all()->pluck('id')->all();
        if($type == 'App\Models\Admin')
            $user_id = \App\Models\Admin::all()->pluck('id')->all();

        return [
            'projectId' => \App\Models\Project::inRandomOrder()->first()->id, 
            'issuedTo' => \App\Models\Client::inRandomOrder()->first()->id, 
            'user_id' => $this->faker->randomElement($user_id),
            'user_type' => $type,
            'confirmed_user_type' => $type, 
            'confirmed_user_id' => $this->faker->randomElement($user_id),
            'amountToPay' => $this->faker->biasedNumberBetween(100, 1000), 
            'dueDate' => $this->faker->date(), 
            'invoiceSerial' => $this->faker->bothify('INV###??'), 
            'paymentEvidence' => \Illuminate\Http\UploadedFile::fake()->create('evidence.pdf')->store('payment evidence files','publicDisk'), 
            'paymentDate' => $this->faker->date, 
            'isPayEvidenceApproved' => $this->faker->randomElement([0, 1]),
        ];
    }
}