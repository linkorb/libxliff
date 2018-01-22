<?php

namespace LinkORB\Xliff\V1\Model;

use JMS\Serializer\Annotation as JmsSerializer;

class Target
{
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $state;
    /**
     * @JmsSerializer\XmlValue(cdata=false)
     * @JmsSerializer\Type("string")
     */
    public $value;

    public function isTranslation()
    {
        return null !== $this->value
            && '' !== $this->value
        ;
    }
}
