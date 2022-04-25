<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $user = User::register($name='Name', $email="email@ex.com", $password='123456789');
        self::assertNotEmpty($user->name);
        self::assertNotEmpty($user->email);
        self::assertNotEmpty($user->password);
        self::assertNotEquals($user->password, $password);
        $this->assertTrue($user->isUser());
        $this->assertFalse($user->isManager());
    }
}
