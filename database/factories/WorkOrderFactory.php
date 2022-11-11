<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkOrder>
 */
class WorkOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $warranty = $this->faker->boolean();


        $invoiceNo = $warranty ? $this->faker->randomNumber(5,true) : null;


        $ticket_no =$this->faker->randomDigit();


        $assigned = $this->faker->randomElement([User::factory(),null]);

        $diagnostic = $this->faker->randomElement([null,$this->faker->sentence()]);


        $chargeable = $this->faker->boolean;

        $approved = $this->faker->boolean;

        $delivery_signature = $this->faker->word();



        $status = "pending";

        if($assigned!=null && $diagnostic==null)
        {
            $status = "assigned";
        }

        if($diagnostic!=null)
        {
            $status= $this->faker->randomElement(['complete','assigned']);
        }



        return [
        'date'=>$this->faker->dateTimeThisDecade(),
        'ticket_no'=>$this->faker->randomElement([null,$ticket_no]),
        'client'=>$this->faker->name(),
        'client_contact_no'=>$this->faker->phoneNumber(),
        'client_email'=>$this->faker->email(),
        'product'=>$this->faker->word(),
        'model'=>$this->faker->word(),
        'accessories'=>$this->faker->word(),
        'serial_no'=>$this->faker->randomNumber(6,true),
        'cyber_serial_no1'=>$this->faker->randomNumber(6,true),
        'cyber_serial_no2'=>$this->faker->randomNumber(6,true),
        'problem_desc'=>$this->faker->sentence(),
        'warranty'=>$warranty,
         'invoice_no'=>$invoiceNo,
         'taken_by'=>User::factory(),
         'assigned_to'=>$assigned,
         'diagnostic'=>$assigned!=null ? $diagnostic : null,
         'diagnostic_date'=> $diagnostic!=null ? $this->faker->dateTimeThisDecade() :null ,
         'chargeable'=> $diagnostic!=null ? $chargeable : null,
         'quotation_no'=>$chargeable? $this->faker->randomNumber(6,true)  : null,
         'quotation_approved'=>$this->faker->randomElement([null,$approved]),
         'client_signature_request'=>$this->faker->word(),
         'client_signature_delivery'=>$this->faker->randomElement([null,$delivery_signature]),
         'status'=>$status
        ];
    }
}
