<?php

namespace LinkORB\Xliff\Serializer;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;

use LinkORB\Xliff\XliffInterface;

interface SerializerInterface
{
    /**
     * Serialise an object which represents the content of an Xliff file.
     *
     * @param \LinkORB\Xliff\XliffInterface $xliff
     * @param null|\JMS\Serializer\SerializationContext $context
     *
     * @return string
     */
    public function serialise(XliffInterface $xliff, SerializationContext $context = null);

    /**
     * Deserialise the content of an Xliff file to an object which implements
     * XliffInterface.
     *
     * @param string $xliffContent
     * @param string $type type of an object which implements XliffInterface
     * @param null|\JMS\Serializer\DeserializationContext $context
     *
     * @return \LinkORB\Xliff\XliffInterface
     */
    public function deserialise($xliffContent, $type, DeserializationContext $context = null);
}
