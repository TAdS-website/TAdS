<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\WebhookInfo;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\GetWebhookInfo;

class GetWebhookInfoTest extends TestCase
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

    public function testGetWebhookInfo()
    {
        $getWebhookInfo = new GetWebhookInfo();

        /** @var WebhookInfo $result */
        $result = $this->tgLog->performApiRequest($getWebhookInfo);

        $this->assertInstanceOf(WebhookInfo::class, $result);
        $this->assertSame('https://telegram.unreal4u.com/XXXYYYZZZ', $result->url);
        $this->assertFalse($result->has_custom_certificate);
        $this->assertEmpty($result->pending_update_count);
    }

    public function testGetWebhookInfoNotSet()
    {
        $this->tgLog->specificTest = 'notset';

        $getWebhookInfo = new GetWebhookInfo();

        /** @var WebhookInfo $result */
        $result = $this->tgLog->performApiRequest($getWebhookInfo);

        $this->assertInstanceOf(WebhookInfo::class, $result);
        $this->assertEmpty($result->url);
        $this->assertFalse($result->has_custom_certificate);
        $this->assertEmpty($result->pending_update_count);
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new GetWebhookInfo();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('getWebhookInfo', $return);
    }
}
