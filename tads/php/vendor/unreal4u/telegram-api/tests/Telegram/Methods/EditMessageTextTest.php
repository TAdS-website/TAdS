<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\EditMessage\Text;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class EditMessageTextTest extends TestCase
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

    /**
     * @expectedException \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage "text"
     */
    public function testMissingMandatoryExportField()
    {
        $editMessageText = new Text();
        $editMessageText->export();
    }

    /**
     * @expectedException \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage text
     */
    public function testMissingMandatoryTextField()
    {
        $editMessageText = new Text();
        $editMessageText->inline_message_id = 12341234;
        $editMessageText->export();
    }

    /**
     * @expectedException \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage message_id
     */
    public function testMissingMandatoryMessageIdField()
    {
        $editMessageText = new Text();
        $editMessageText->chat_id = 12341234;
        $editMessageText->text = 'Hello world';
        $editMessageText->export();
    }

    public function testMissingMandatoryInlineMessageIdField()
    {
        $editMessageText = new Text();

        $this->assertContains('inline_message_id', $editMessageText->getMandatoryFields());
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new Text();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('editMessageText', $return);
    }
}
