<?php
namespace OmisePlugin\Contexts;

use OmisePlugin\Contexts\OmisePluginDemoContext;
use Exception;

class Context
{
    /**
     * A registered context list.
     *
     * @var array
     */
    protected $registered_contexts = array(
        'stdClass' => OmisePluginDemoContext::class
    );

    /**
     * A concrete context class.
     *
     * @var OmisePlugin\Contexts\ContextInterface
     */
    protected $context;

    /**
     * Read a context from an object.
     *
     * @param  object $object
     *
     * @return self
     */
    public function readFromObject($object)
    {
        $context       = $this->read(get_class($object));
        $this->context = new $context;

        return $this;
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
}