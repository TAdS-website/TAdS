<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SetWebhook;

class SetWebhookTest extends TestCase
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

    public function testSetWebhook()
    {
        $setWebhook = new SetWebhook();

        /** @var ResultBoolean $result */
        $result = $this->tgLog->performApiRequest($setWebhook);

        $this->assertInstanceOf(ResultBoolean::class, $result);
        $this->assertTrue($result->data);
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new SetWebhook();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('setWebhook', $return);
    }
}
