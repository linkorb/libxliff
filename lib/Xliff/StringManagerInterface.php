<?php

namespace LinkORB\Xliff;

/**
 * Interface for translation string managers.
 */
interface StringManagerInterface
{
    /**
     * Add to the supplied Xliff all of the supplied strings which aren't
     * already present in the Xliff.
     *
     * @param \LinkORB\Xliff\XliffInterface $xliff
     * @param array $strings Associative array of string IDs to strings
     *
     * @return array IDs of strings added
     */
    public function addStrings(XliffInterface $xliff, array $strings);

    /**
     * Remove from the supplied Xliff all strings which aren't present in the
     * supplied strings.
     *
     * @param \LinkORB\Xliff\XliffInterface $xliff
     * @param array $strings Associative array of string IDs to strings
     *
     * @return array IDs of strings removed
     */
    public function removeStrings(XliffInterface $xliff, array $strings);

    /**
     * Replace strings of the supplied Xliff where their values do not match
     * those of the supplied strings.
     *
     * @param \LinkORB\Xliff\XliffInterface $xliff
     * @param array $strings Associative array of string IDs to strings
     *
     * @return array IDs of strings replaced
     */
    public function replaceStrings(XliffInterface $xliff, array $strings);
}
