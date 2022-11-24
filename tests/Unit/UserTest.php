<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use UserSeeder;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private function randomId()
    {
        $randomUser = User::inRandomOrder()->first();
        return $randomUser->id;
    }

    public function test_GetAllData()
    {
        $this->seed(UserSeeder::class);
        $response = $this->getJson('/api/users');
        $response->assertStatus(200);
        $response->assertSeeText([
            'id', 'nama', 'email', 'telepon',
            'created_at', 'updated_at'
        ]);
    }

    public function test_GetDataById()
    {
        $this->seed(UserSeeder::class);
        $response = $this->getJson('/api/users/'.$this->randomId());
        $response->assertStatus(200);
        $response->assertSeeText([
            'id', 'nama', 'email', 'telepon',
            'created_at', 'updated_at'
        ]);
    }
}
