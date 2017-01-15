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
     * @param  string $context_name
     * @param  mixed  $param
     *
     * @return \OmisePlugin\Repository
     */
    public static function create($context_name, $params)
    {
        $repository = new self(new Context, null);
        $repository->attachContextByName($context_name);
        $repository->object = $repository->context->execute('create', array('params' => $params));

        return $repository;
    }

    /**
     * Initiate Repository instance.
     *
     * @param  object $object
     *
     * @return \OmisePlugin\Repository
     */
    public static function add($object)
    {
        $repository = new self(new Context, $object);
        $repository->attachContextByObject($object);

        return $repository;
    }

    /**
     * @param object $object
     */
    public function attachContextByObject($object)
    {
        $this->context->readFromObject($object);
    }

    /**
     * @param string $name
     */
    public function attachContextByName($name)
    {
        $this->context->readFromName($name);
    }

    /**
     * Execute function from context.
     *
     * @param  string $method
     * @param  array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $args);
        }

        return $this->context->execute($method, $args, $this->object);
    }
}
