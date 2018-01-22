<?php

namespace LinkORB\Xliff\V1\Model;

use JMS\Serializer\Annotation as JmsSerializer;

class TranslationUnit
{
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $id;
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $resname;
    /**
     * @JmsSerializer\XmlAttribute
     * @JmsSerializer\Type("string")
     */
    public $approved;
    /**
     * @JmsSerializer\XmlElement
     * @JmsSerializer\Type("LinkORB\Xliff\V1\Model\Source")
     */
    public $source;
    /**
     * @JmsSerializer\XmlElement
     * @JmsSerializer\Type("LinkORB\Xliff\V1\Model\Target")
     */
    public $target;
    /**
     * @var \LinkORB\Xliff\V1\Model\Note[]
     * @JmsSerializer\Type("array<LinkORB\Xliff\V1\Model\Note>")
     * @JmsSerializer\XmlList(inline=true, entry="note")
     * @JmsSerializer\Accessor(setter="setNotes")
     */
    protected $notes = [];

    public function setNotes(array $notes)
    {
        foreach ($notes as $note) {
            $this->addNote($note);
        }
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function addNote(Note $note)
    {
        $this->notes[] = $note;
    }

    public function hasTranslation()
    {
        if (!$this->target) {
            return false;
        }
        return $this->target->isTranslation();
    }
}
