<?php

namespace LinkORB\Xliff\V1\Factory;

use LinkORB\Xliff\V1\Model\Body;
use LinkORB\Xliff\V1\Model\File;
use LinkORB\Xliff\V1\Model\Note;
use LinkORB\Xliff\V1\Model\Source;
use LinkORB\Xliff\V1\Model\Target;
use LinkORB\Xliff\V1\Model\TranslationUnit;
use LinkORB\Xliff\V1\Model\Xliff;

/**
 * Create objects of the V1 Xliff Model.
 */
class XliffFactory
{
    /**
     * Create an instance of Xliff.
     *
     * @param null|\LinkORB\Xliff\V1\Model\File $file
     *
     * @return \LinkORB\Xliff\V1\Model\Xliff
     */
    public function createXliff(File $file = null)
    {
        $xliff = new Xliff;
        $xliff->file = $file;
        return $xliff;
    }

    /**
     * Create an instance of File.
     *
     * @param null|\LinkORB\Xliff\V1\Model\Body $body
     * @param array $attributes
     *
     * @return \LinkORB\Xliff\V1\Model
     */
    public function createFile(Body $body = null, $attributes = [])
    {
        $file = new File;
        if (isset($attributes['original'])) {
            $file->original = $attributes['original'];
        }
        if (isset($attributes['sourceLanguage'])) {
            $file->sourceLanguage = $attributes['sourceLanguage'];
        }
        if (isset($attributes['datatype'])) {
            $file->datatype = $attributes['datatype'];
        }
        if (isset($attributes['targetLanguage'])) {
            $file->targetLanguage = $attributes['targetLanguage'];
        }
        $file->body = $body;
        return $file;
    }

    /**
     * Create an instance of Body.
     *
     * @param \LinkORB\Xliff\V1\Model\TranslationUnit[] $translationUnits
     *
     * @return \LinkORB\Xliff\V1\Model\Body
     */
    public function createBody(array $translationUnits = [])
    {
        $body = new Body;
        foreach ($translationUnits as $translationUnit) {
            $body->addTranslationUnit($translationUnit);
        }
        return $body;
    }

    /**
     * Create an instance of TranslationUnit.
     *
     * @param null|\LinkORB\Xliff\V1\Model\Source $source
     * @param null|\LinkORB\Xliff\V1\Model\Target $target
     * @param array $attributes
     * @param \LinkORB\Xliff\V1\Model\Note[] $notes
     *
     * @return \LinkORB\Xliff\V1\Model\TranslationUnit
     */
    public function createTranslationUnit(Source $source = null, Target $target = null, array $attributes = [], array $notes = [])
    {
        $translationUnit = new TranslationUnit;
        if (isset($attributes['id'])) {
            $translationUnit->id = $attributes['id'];
        }
        if (isset($attributes['resname'])) {
            $translationUnit->resname = $attributes['resname'];
        }
        $translationUnit->source = $source;
        $translationUnit->target = $target;
        foreach ($notes as $note) {
            $translationUnit->addNote($note);
        }
        return $translationUnit;
    }

    /**
     * Create an instance of Source.
     *
     * @param null|string $value
     *
     * @return \LinkORB\Xliff\V1\Model\Source
     */
    public function createSource($value = '')
    {
        $source = new Source;
        $source->value = $value;
        return $source;
    }

    /**
     * Create an instance of Target.
     *
     * @param null|string $value
     *
     * @return \LinkORB\Xliff\V1\Model\Target
     */
    public function createTarget($value = '')
    {
        $target = new Target;
        $target->value = $value;
        return $target;
    }

    /**
     * Create an instance of Note.
     *
     * @param null|string $value
     *
     * @return \LinkORB\Xliff\V1\Model\Note
     */
    public function createNote($value = '', array $attributes = [])
    {
        $note = new Note;
        $note->value = $value;
        if (isset($attributes['from'])) {
            $note->from = $attributes['from'];
        }
        return $note;
    }
}
