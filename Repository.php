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
     * @var \OmiseApiResource
     *
     * @see http://github.com/omise/omise-php/blob/master/lib/omise/res/OmiseApiResource.php
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
}