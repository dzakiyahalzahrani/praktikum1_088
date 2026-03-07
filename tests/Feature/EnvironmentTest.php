<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{


      public function testGetEnv()
    {
        $youtube = env('YOUTUBE');

        self::assertEquals('Programmer Zaman Now', $youtube);
    }

     public function testDefaultEnv()
    {
        //$author = env('AUTHOR', 'Asroni');
        $author = env('AUTHOR', 'Roni');
        
        self::assertEquals('Roni', $author);

     
    }

         public function testDefaultEnv3()
    {
        $author = env('AUTHOR', 'Roni');

        $this->assertEquals('Roni', $author);
    }





    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
