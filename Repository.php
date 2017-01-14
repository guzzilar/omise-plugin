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
     * @param object                        $object
     */
    public function __construct(Context $context, $object)
    {
        $this->context = $context;
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
        $repository = new self(new Context, $object);
        $repository->attachContext($object);

        return $repository;
    }

    /**
     * @param object $object
     */
    public function attachContext($object)
    {
        $this->context->readFromObject($object);
    }
}