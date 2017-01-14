<?php
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
        $context    = Mockery::mock(Context::class);
        $object     = Mockery::mock(stdClass::class);

        // Assertion.
        $context->shouldReceive('read')
            ->once()
            ->andReturn('OmisePlugin\\Contexts\\OmiseChargeContext');
        $this->assertEquals(Repository::class, get_class(new Repository($context, $object)));
    }
}