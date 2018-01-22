<?php

namespace LinkORB\Xliff\V1\Model;

use JMS\Serializer\Annotation as JmsSerializer;

class Note
{
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $from;

    /**
     * @JmsSerializer\XmlValue
     * @JmsSerializer\Type("string")
     */
    public $value;
}
