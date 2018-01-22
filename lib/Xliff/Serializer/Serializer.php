<?php

namespace LinkORB\Xliff\Serializer;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer as JmsSerializer;

use LinkORB\Xliff\XliffInterface;

/**
 * A thin wrapper around the JMS Serializer for developer convenience.
 */
class Serializer implements SerializerInterface
{
    const FORMAT_XML = 'xml';

    private $serializer;

    public function setSerializer(JmsSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialise(XliffInterface $xliff, SerializationContext $context = null)
    {
        return $this->serializer->serialize($xliff, self::FORMAT_XML, $context);
    }

    public function deserialise($xliffContent, $type, DeserializationContext $context = null)
    {
        return $this->serializer->deserialize($xliffContent, $type, self::FORMAT_XML, $context);
    }
}
