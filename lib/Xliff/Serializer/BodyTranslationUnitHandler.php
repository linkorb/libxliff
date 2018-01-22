<?php

namespace LinkORB\Xliff\Serializer;

use SimpleXMLElement;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\XmlDeserializationVisitor;

use LinkORB\Xliff\V1\Model\Body;

class BodyTranslationUnitHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => Body::class,
                'method' => 'deserialiseBodyTranslationUnits',
            ),
        );
    }

    /**
     * Populate Body with a list of TranslationUnit.
     *
     * Serializer won't automatically deserialise the "trans-unit" elements of
     * and Xliff file into a Body.translationUnits forFor some as yet unknown
     * reason.  Hence this handler.
     *
     * @param \JMS\Serializer\XmlDeserializationVisitor $visitor
     * @param \SimpleXMLElement $data
     * @param array $type
     * @param \JMS\Serializer\Context $context
     *
     * @return \LinkORB\Xliff\V1\Model\Body
     */
    public function deserialiseBodyTranslationUnits(
        XmlDeserializationVisitor $visitor,
        SimpleXMLElement $data,
        array $type,
        Context $context
    ) {
        $body = new Body;
        $bodyMetadata = $context->getMetadataFactory()->getMetadataForClass(Body::class);
        $visitor->startVisitingObject($bodyMetadata, $body, $type, $context);
        // switch the "xmlEntryName" metadata of Body.translationUnits to an xpath
        // which will retrieve the trans-unit nodes from a SimpleXML array
        $transUnitPropertyMetadata = $bodyMetadata->propertyMetadata['translationUnits'];
        $savedEntryName = $transUnitPropertyMetadata->xmlEntryName;
        $transUnitPropertyMetadata->xmlEntryName = '*[@id and @resname]';
        $visitor->visitProperty($transUnitPropertyMetadata, $data, $context);
        $body = $visitor->endVisitingObject($bodyMetadata, $body, $type, $context);
        // restore "xmlEntryName" so it can still be used in the DIRECTION_SERIALIZATION
        $transUnitPropertyMetadata->xmlEntryName = $savedEntryName;
        return $body;
    }
}
