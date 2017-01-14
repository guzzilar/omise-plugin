<?php
use Exception as Exception;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use stdClass as stdClass;
use OmisePlugin\Repository;
use OmisePlugin\Contexts\Context;

class RepositoryTest extends MockeryTestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function init_new_instance()
    {
        // Initialisation.
        $context = Mockery::mock(Context::class);
        $object  = Mockery::mock(stdClass::class);

        // Assertion.
        $context->shouldReceive('readFromObject')
            ->once()
            ->andReturn('OmisePlugin\\Contexts\\OmiseChargeContext');

        $repository = new Repository($context, $object);
        $repository->attachContext($object);

        $this->assertEquals(Repository::class, get_class($repository));
    }

    /**
     * @test
     * @expectedException        Exception
     * @expectedExceptionMessage Mockery_1_stdClass context not found
     */
    public function cannot_create_new_repository_from_unknow_object()
    {
        // Initialisation.
        $object = Mockery::mock(stdClass::class);

        // Assertion.
        Repository::create($object);
    }
}