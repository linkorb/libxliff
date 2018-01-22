<?php

namespace LinkORB\Xliff\V1\Generator;

use LinkORB\Xliff\V1\Factory\XliffFactory;
use LinkORB\Xliff\XliffGeneratorInterface;

/**
 * Generate a basic Model of V1 Xliff.
 */
class BasicGenerator implements XliffGeneratorInterface
{
    private $xliffFactory;

    public function __construct(XliffFactory $xliffFactory)
    {
        $this->xliffFactory = $xliffFactory;
    }

    public function generate(array $sourceStrings, array $targetStrings = [], array $attributes = [])
    {
        $body = $this->xliffFactory->createBody();
        foreach ($sourceStrings as $id => $sourceString) {
            $body->addTranslationUnit(
                $this->xliffFactory->createTranslationUnit(
                    $this->xliffFactory->createSource($sourceString),
                    $this->xliffFactory->createTarget(
                        isset($targetStrings[$id]) ? $targetStrings[$id] : $sourceString
                    ),
                    [
                        'id' => $id,
                        'resname' => $id,
                    ]
                ),
                $id
            );
        }

        return $this->xliffFactory->createXliff(
            $this->xliffFactory->createFile(
                $body,
                isset($attributes['File']) ? $attributes['File'] : []
            )
        );
    }
}
