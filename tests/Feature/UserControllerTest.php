<?php

namespace Tests\Feature;

use App\Model\Language;
use App\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testFormRender()
    {
        $response = $this->get('/users/form');

        $response->assertViewIs("users.form");
    }

    public function testCanAddNewUser()
    {
        $response = $this->post("/users/form", [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "email" => $this->faker->email,
            "pesel" => "97060809315",
            "languages" => ["PHP", "JS"]
        ]);

        $this->assertEquals(1, User::query()->count());

        $response->assertRedirect("/users/show/1");
    }

    public function testLanguagesDoNotDuplicate()
    {
        $data1 = [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "email" => $this->faker->email,
            "pesel" => "97060809315",
            "languages" => ["PHP", "JS"]
        ];

        $data2 = [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "email" => $this->faker->email,
            "pesel" => "94031409315",
            "languages" => ["PHP", "C#"]
        ];

        $this->post("/users/form", $data1);

        $this->assertEquals(2, Language::query()->count());

        $this->post("/users/form", $data2);

        $this->assertEquals(3, Language::query()->count());

        $this->assertEquals(2, User::query()->count());
    }
}
