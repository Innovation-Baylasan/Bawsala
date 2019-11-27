<?php

namespace Tests\Unit;

use App\Activity;
use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function its_belong_to_a_company()
    {
        $company = factory(Company::class)->create();

        $activity = factory(Activity::class)->create([
            'company_id' => $company->id
        ]);


        $this->assertEquals($company->toArray(), $activity->company->toArray());
    }
}

