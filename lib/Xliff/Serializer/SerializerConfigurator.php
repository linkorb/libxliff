<?php

namespace LinkORB\Xliff\Serializer;

use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;


/**
 * Configure the Serializer service.
 */
class SerializerConfigurator
{
    protected $debug;
    protected $cacheDir;

    public function __construct($debug = false, $cacheDir = null)
    {
        $this->debug = $debug;
        $this->cacheDir = $cacheDir;
    }

    /**
     * Configure and build the JMS Serializer service and inject it into the
     * Library Serializer service.
     *
     * @param \LinkORB\Xliff\Serializer\Serializer $serializer
     */
    public function configure(Serializer $serializer)
    {
        $serializer->setSerializer($this->buildSerializer());
    }

    public function buildSerializer()
    {
        $serializerBuilder = SerializerBuilder::create()
            ->setDebug($this->debug)
            ->setSerializationContextFactory(
                function () {
                    return SerializationContext::create()
                        ->setSerializeNull(false)
                    ;
                }
            )
            ->configureHandlers(
                function (HandlerRegistry $registry) {
                    $registry->registerSubscribingHandler(new BodyTranslationUnitHandler);
                }
            )
        ;
        if ($this->cacheDir) {
            $serializerBuilder->setCacheDir($this->cacheDir);
        }
        return $serializerBuilder->build();
    }
}
