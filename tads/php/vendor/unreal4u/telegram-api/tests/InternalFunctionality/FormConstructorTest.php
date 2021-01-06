<?php

namespace unreal4u\TelegramAPI\tests\InternalFunctionality;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\InternalFunctionality\FormConstructor;

class FormConstructorTest extends TestCase
{
    /**
     * @var FormConstructor
     */
    private $formConstructor;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->formConstructor = new FormConstructor();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->formConstructor = null;
        parent::tearDown();
    }

    public function providerBuildMultipartFormData()
    {
        $mapValues[] = [
            [
                'id' => 'lala',
                'contents' => 'lolo',
            ],
            'non-existant',
            null,
            [
                'multipart' => [
                    0 => [
                        'name' => 'id',
                        'contents' => 'lala',
                    ],
                    1 => [
                        'name' => 'contents',
                        'contents' => 'lolo',
                    ]
                ]
            ],
        ];

        $mapValues[] = [[], '', null, ['multipart' => [],]];

        return $mapValues;
    }

    /**
     * @dataProvider providerBuildMultipartFormData
     */
    public function testBuildMultipartFormData(array $data, string $fileKeyName, $stream = null, array $expected = [])
    {
        $result = $this->formConstructor->buildMultipartFormData($data, $fileKeyName, $stream);
        $this->assertEquals($expected, $result);
    }
}
