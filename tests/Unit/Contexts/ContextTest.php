<?php
use Exception as Exception;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use stdClass as stdClass;
use OmisePlugin\Repository;
use OmisePlugin\Contexts\Context;

class ContextTest extends MockeryTestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function read_a_context()
    {
        // Initialisation.
        $object  = new stdClass;
        $context = new Context;
        $context->readFromObject($object);

        // Assertion.
        $this->assertEquals(Context::class, get_class($context));
        $this->assertEquals('OmisePlugin\Contexts\OmisePluginDemoContext', $context->name());
    }

    /**
     * @test
     * @expectedException        Exception
     * @expectedExceptionMessage noneDefinedObject context not found
     */
    public function cannot_read_context_from_none_defined_object()
    {
        // Initialisation.
        $context = new Context;

        // Assertion.
        $context->read('noneDefinedObject');
    }
}