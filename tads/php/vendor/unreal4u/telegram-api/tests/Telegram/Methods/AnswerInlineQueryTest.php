<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\AnswerInlineQuery;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Article;
use PHPUnit_Framework_TestCase as TestCase;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent\Text;

#use PHPUnit\Framework\TestCase;

class AnswerInlineQueryTest extends TestCase
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

    public function testAnswerInlineQuery()
    {
        $inlineQueryResultArticle = new Article();
        $inlineQueryResultArticle->url = 'https://unreal4u.com/';
        $inlineQueryResultArticle->title = 'The title';

        $inputMessageContentText = new Text();
        $inputMessageContentText->message_text = 'The message text';
        $inputMessageContentText->disable_web_page_preview = true;
        $inlineQueryResultArticle->id = 'unit-test-001';

        $inlineQueryResultArticle->input_message_content = $inputMessageContentText;
        $inlineQueryResultArticle->id = md5(json_encode(['uid' => '111', 'iqid' => '222', 'rid' => '33']));

        $answerInlineQuery = new AnswerInlineQuery();
        $answerInlineQuery->inline_query_id = 123412341234;
        $answerInlineQuery->addResult($inlineQueryResultArticle);

        /** @var ResultBoolean $result */
        $result = $this->tgLog->performApiRequest($answerInlineQuery);

        $this->assertEquals(
            trim(file_get_contents('tests/Mock/MockData/AnswerInlineQueryArticle_unit-test-001.json')),
            $answerInlineQuery->getResults()
        );

        $this->assertInstanceOf(ResultBoolean::class, $result);
        $this->assertTrue($result->data);
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new AnswerInlineQuery();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('answerInlineQuery', $return);
    }
}
