<?php

namespace LinkORB\Xliff\V1\Model;

use JMS\Serializer\Annotation as JmsSerializer;
use LinkORB\Xliff\XliffInterface;

/**
 * @JmsSerializer\XmlRoot("xliff")
 */
class Xliff implements XliffInterface
{
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $version = '1.2';
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $xmlns = 'urn:oasis:names:tc:xliff:document:1.2';
    /**
     * @var \LinkORB\Xliff\V1\Model\File
     * @JmsSerializer\Type("LinkORB\Xliff\V1\Model\File")
     */
    public $file;
}
