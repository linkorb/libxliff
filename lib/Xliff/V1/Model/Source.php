<?php

namespace LinkORB\Xliff\V1\Model;

use JMS\Serializer\Annotation as JmsSerializer;

class Source
{
    /**
     * @JmsSerializer\XmlValue(cdata=false)
     * @JmsSerializer\Type("string")
     */
    public $value;
}
