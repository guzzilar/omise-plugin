<?php
namespace OmisePlugin;

use OmisePlugin\Contexts\Context;

class Repository
{
    /**
     * @var \OmisePlugin\Contexts\Context
     */
    protected $context;

    /**
     * @var object
     */
    protected $object;

    /**
     * @param \OmisePlugin\Contexts\Context $context
     * @param \OmiseApiResource             $object
     */
    public function __construct($context, $object)
    {
        $this->context = $context->read($object);
        $this->object  = $object;
    }

    /**
     * Initiate Repository instance.
     *
     * @param  object $object
     *
     * @return \OmisePlugin\Repository
     */
    public static function create($object)
    {
        return new self(new Context, $object);
    }
}