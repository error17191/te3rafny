<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_public_questions()
    {
        $this->assertTrue(true);

    }
}
