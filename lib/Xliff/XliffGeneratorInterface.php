<?php

namespace LinkORB\Xliff;

/**
 * Interface for generators of Xliff object graphs.
 */
interface XliffGeneratorInterface
{
    /**
     * Generate an object representing the content of an Xliff file.
     *
     * @param array $sourceStrings Associative array of string IDs to source
     *                             strings.
     * @param array $targetStrings Optional associative array of string IDs to
     *                             target strings.
     * @param array $attributes Optional associative array of attribute name
     *                          value pairs, keyed by the name of the xliff
     *                          model (e.g. TranslationUnit)
     *
     * @return \LinkORB\Xliff\V1\Model\Xliff
     */
    public function generate(
        array $sourceStrings,
        array $targetStrings = [],
        array $attributes = []
    );
}
