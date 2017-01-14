<?php
namespace OmisePlugin\Contexts;

use Exception;

class Context
{
    /**
     * A registered context list.
     *
     * @var array
     */
    protected $registered_contexts = array();

    /**
     * A concrete context class.
     *
     * @var OmisePlugin\Contexts\ContextInterface
     */
    protected $context;

    /**
     * Read an object context.
     *
     * @param  \OmiseApiResource $object
     *
     * @return string
     *
     * @throws \Exception if context not found.
     */
    public function read($object)
    {
        if (isset($this->registered_contexts[get_class($object)])) {
            return $this->registered_contexts[get_class($object)];
        }

        throw new Exception(get_class($object) . " context not found");
    }
}