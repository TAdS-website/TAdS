<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendLocation;
use unreal4u\TelegramAPI\Telegram\Types\Location;
use unreal4u\TelegramAPI\Telegram\Types\Chat;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\User;

class SendLocationTest extends TestCase
{
    /**
     * @var MockTgLog
     */
    private $tgLog;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->tgLog = new MockTgLog('TEST-TEST');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->tgLog = null;
        parent::tearDown();
    }

    public function testSendLocation()
    {
        $sendLocation = new SendLocation();
        $sendLocation->chat_id = 12341234;
        $sendLocation->latitude = 43.296482;
        $sendLocation->longitude = 5.369763;

        /** @var Message $result */
        $result = $this->tgLog->performApiRequest($sendLocation);
        $this->assertInstanceOf(Message::class, $result);

        $this->assertEquals(13, $result->message_id);
        $this->assertInstanceOf(User::class, $result->from);
        $this->assertInstanceOf(Chat::class, $result->chat);
        $this->assertEquals(123456789, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendLocation->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452209867, $result->date);
        $this->assertNull($result->audio);

        $this->assertInstanceOf(Location::class, $result->location);
        // We have to round because what we send isn't necessarily what we get
        $this->assertEquals(round($sendLocation->latitude, 6), round($result->location->latitude, 6));
        $this->assertEquals(round($sendLocation->longitude, 6), round($result->location->longitude, 6));
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new SendLocation();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('sendLocation', $return);
    }
}
