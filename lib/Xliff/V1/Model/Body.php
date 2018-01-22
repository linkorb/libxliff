<?php

namespace LinkORB\Xliff\V1\Model;

use JMS\Serializer\Annotation as JmsSerializer;

class Body
{
    /**
     * @var \LinkORB\Xliff\V1\Model\TranslationUnit[]
     * @JmsSerializer\Type("array<LinkORB\Xliff\V1\Model\TranslationUnit>")
     * @JmsSerializer\XmlList(inline=true, entry="trans-unit")
     * @JmsSerializer\Accessor(setter="setTranslationUnits")
     */
    protected $translationUnits = [];

    public function setTranslationUnits(array $translationUnits)
    {
        foreach ($translationUnits as $translationUnit) {
            $this->addTranslationUnit($translationUnit, $translationUnit->id);
        }
    }

    public function addTranslationUnit(TranslationUnit $translationUnit, $id)
    {
        $this->translationUnits[$id] = $translationUnit;
    }

    public function getTranslationUnitIds()
    {
        return array_keys($this->translationUnits);
    }

    public function getTranslationUnit($id)
    {
        if (!array_key_exists($id, $this->translationUnits)) {
            return null;
        }
        return $this->translationUnits[$id];
    }

    public function removeTranslationUnit($id)
    {
        if (!array_key_exists($id, $this->translationUnits)) {
            return;
        }
        unset($this->translationUnits[$id]);
    }
}
