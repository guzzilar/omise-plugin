<?php
use Exception as Exception;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use stdClass as stdClass;
use OmisePlugin\Repository;
use OmisePlugin\Contexts\Context;

class RepositoryTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function init_new_instance()
    {
        // Initialisation.
        $context = Mockery::mock(Context::class);
        $object  = Mockery::mock(stdClass::class);

        // Assertion.
        $context->shouldReceive('read')
            ->once()
            ->andReturn('OmisePlugin\\Contexts\\OmiseChargeContext');
        $this->assertEquals(Repository::class, get_class(new Repository($context, $object)));
    }

    /**
     * @test
     * @expectedException        Exception
     * @expectedExceptionMessage Mockery_1_stdClass context not found
     */
    public function context_reader_cannot_read_the_context_from_an_object()
    {
        // Initialisation.
        $object = Mockery::mock(stdClass::class);

        // Assertion.
        Repository::create($object);
    }
}