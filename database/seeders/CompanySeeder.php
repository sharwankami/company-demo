<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate the company table
        Company::truncate();

        //insert 20 random Company records in database
        $faker= Faker::create();
        for($cnt=0;$cnt<20;$cnt++){
            Company::create([
                'name'=>$faker->company(),
                'organization_number'=>$faker->unique()->randomNumber(),
                'street_name'=>$faker->streetAddress(),
                'house_number'=>$faker->buildingNumber(),
                'zip_code'=>$faker->postcode(),
                'country'=>$faker->countryCode(),
                'phone'=>$faker->phoneNumber(),
                'email'=>$faker->unique()->safeEmail(),
            ]);
        }
    }
}
