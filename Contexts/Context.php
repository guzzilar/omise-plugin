<?php
namespace OmisePlugin\Contexts;

use Exception;
use OmisePlugin\Contexts\OmisePluginDemoContext;

class Context
{
    /**
     * A registered context list.
     *
     * @var array
     */
    protected $registered_contexts = array(
        'stdClass'    => OmisePluginDemoContext::class,
        'OmiseCharge' => OmiseChargeContext::class
    );

    /**
     * A concrete context class.
     *
     * @var OmisePlugin\Contexts\ContextInterface
     */
    protected $context;

    /**
     * @return string
     */
    public function name()
    {
        return get_class($this->context);
    }

    /**
     * Read a context from an object.
     *
     * @param  object $object
     *
     * @return void
     */
    public function readFromObject($object)
    {
        $context       = $this->read(get_class($object));
        $this->context = new $context;
    }

    /**
     * Read a context from name.
     *
     * @param  string $name
     *
     * @return void
     */
    public function readFromName($name)
    {
        $context       = $this->read($name);
        $this->context = new $context;
    }

    /**
     * Check if context is exists given by a target context name.
     *
     * @param  string $context_name
     *
     * @return string
     *
     * @throws \Exception if context not found.
     */
    public function read($context_name)
    {
        if (! isset($this->registered_contexts[$context_name])) {
            throw new Exception($context_name . " context not found");
        }

        return $this->registered_contexts[$context_name];
    }

    /**
     * @param  string      $method
     * @param  array       $args
     * @param  null|object $object
     *
     * @return mixed
     */
    public function execute($method, $args, $object = null)
    {
        if (! is_null($object)) {
            array_unshift($args, $object);
        }

        return call_user_func_array(array($this->context, $method), $args);
    }
}
