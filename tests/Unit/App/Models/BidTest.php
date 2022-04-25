<?php
/**
 * Created by topalek
 * Date: 20.04.2022
 * Time: 12:40
 */

namespace App\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Bid;

class BidTest extends TestCase
{
    use DatabaseTransactions;
    protected $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::whereRole(User::ROLE_USER)->first();
        \Auth::login($this->user);
    }

    public function testNew()
    {
        $bid = Bid::new($subject = '123', $message = '321', '');

        self::assertNotEmpty($bid->subject);
        self::assertNotEmpty($bid->message);
        self::assertNotEmpty($bid->user_id);
        self::assertEmpty($bid->file);
        self::assertEquals($bid->subject, $subject);
        self::assertEquals($bid->message, $message);
    }

    public function testApprove()
    {
        $bid = Bid::new($subject = '123', $message = '321', '');

        $bid->approve();

        self::assertNotEmpty($bid->subject);
        self::assertNotEmpty($bid->message);
        self::assertNotEmpty($bid->user_id);
        self::assertEmpty($bid->file);
        self::assertEquals($bid->subject, $subject);
        self::assertEquals($bid->message, $message);
        self::assertTrue($bid->isApproved());

        $this->expectExceptionMessage('Bid already approved');
        $bid->approve();

    }

}
