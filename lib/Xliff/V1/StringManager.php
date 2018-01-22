<?php

namespace LinkORB\Xliff\V1;

use LinkORB\Xliff\StringManagerInterface;
use LinkORB\Xliff\V1\Factory\XliffFactory;
use LinkORB\Xliff\XliffInterface;

/**
 * Add and remove translation strings.
 */
class StringManager implements StringManagerInterface
{
    private $xliffFactory;

    public function __construct(XliffFactory $xliffFactory)
    {
        $this->xliffFactory = $xliffFactory;
    }

    public function addStrings(XliffInterface $xliff, array $strings)
    {
        $idsOfStringsToAdd = array_diff(
            array_keys($strings),
            $this->getIdsOfStrings($xliff)
        );
        foreach ($idsOfStringsToAdd as $id) {
            $xliff->file->body->addTranslationUnit(
                $this->xliffFactory->createTranslationUnit(
                    $this->xliffFactory->createSource($strings[$id]),
                    $this->xliffFactory->createTarget($strings[$id]),
                    [
                        'id' => $id,
                        'resname' => $id,
                    ]
                ),
                $id
            );
        }
        return $idsOfStringsToAdd;
    }

    public function removeStrings(XliffInterface $xliff, array $strings)
    {
        $idsOfStringsToRemove = array_diff(
            $this->getIdsOfStrings($xliff),
            array_keys($strings)
        );
        foreach ($idsOfStringsToRemove as $id) {
            $xliff->file->body->removeTranslationUnit($id);
        }
        return $idsOfStringsToRemove;
    }

    public function replaceStrings(XliffInterface $xliff, array $strings)
    {
        $idsOfReplacedStrings = [];
        foreach ($strings as $id => $value) {
            if (null === $currentString = $xliff->file->body->getTranslationUnit($id)) {
                continue;
            }
            if ($value === $currentString->source->value) {
                continue;
            }
            $idsOfReplacedStrings[] = $id;
            $xliff->file->body->removeTranslationUnit($id);
            $xliff->file->body->addTranslationUnit(
                $this->xliffFactory->createTranslationUnit(
                    $this->xliffFactory->createSource($value),
                    $this->xliffFactory->createTarget($value),
                    [
                        'id' => $id,
                        'resname' => $id,
                    ]
                ),
                $id
            );
        }
        return $idsOfReplacedStrings;
    }

    private function getIdsOfStrings(XliffInterface $xliff)
    {
        return $xliff->file->body->getTranslationUnitIds();
    }
}
