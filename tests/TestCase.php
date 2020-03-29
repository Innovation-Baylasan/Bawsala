<?php

namespace Tests;

use App\Category;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\UploadedFile;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function signIn($user = null, $driver = null)
    {
        return $this->actingAs($user ?: factory('App\User')->create(), $driver);
    }
}
