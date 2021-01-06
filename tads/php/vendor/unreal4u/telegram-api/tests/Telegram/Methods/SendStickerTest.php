<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Chat;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\Sticker;
use unreal4u\TelegramAPI\Telegram\Types\PhotoSize;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendSticker;

class SendStickerTest extends TestCase
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

    public function testSendSticker()
    {
        $sendSticker = new SendSticker();
        $sendSticker->chat_id = 12341234;
        $sendSticker->sticker = 'BQADBAADsgUAApv7sgABW0IQT2B3WekC';

        /** @var Message $result */
        $result = $this->tgLog->performApiRequest($sendSticker);

        $this->assertInstanceOf(Message::class, $result);
        $this->assertEquals(17, $result->message_id);
        $this->assertInstanceOf(User::class, $result->from);
        $this->assertInstanceOf(Chat::class, $result->chat);
        $this->assertEquals(12345678, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendSticker->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452640389, $result->date);
        $this->assertNull($result->document);
        $this->assertNull($result->voice);
        $this->assertNull($result->video);

        $this->assertInstanceOf(Sticker::class, $result->sticker);
        $this->assertEquals($sendSticker->sticker, $result->sticker->file_id);
        $this->assertInstanceOf(PhotoSize::class, $result->sticker->thumb);
        $this->assertEquals(128, $result->sticker->thumb->height);

        $this->assertSame('{"key":"value"}', $result->sticker->unknown_field);
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new SendSticker();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('sendSticker', $return);
    }
}
