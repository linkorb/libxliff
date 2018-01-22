<?php

namespace LinkORB\Xliff\V1\Model;

use JMS\Serializer\Annotation as JmsSerializer;

class File
{
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\SerializedName("source-language")
     * @JmsSerializer\Type("string")
     */
    public $sourceLanguage;
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $datatype;
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $original;
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\SerializedName("target-language")
     * @JmsSerializer\Type("string")
     */
    public $targetLanguage;
    /**
     * @var \LinkORB\Xliff\V1\Model\Body
     * @JmsSerializer\XmlElement
     * @JmsSerializer\Type("LinkORB\Xliff\V1\Model\Body")
     */
    public $body;
}
