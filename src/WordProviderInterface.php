<?php
/**
 * Created by Michał Nowacki
 * Date: 23/11/2019
 * Time: 20:08
 * Filename: WordProviderInterface.php
 */

namespace KnpU\LoremIpsumBundle;


interface WordProviderInterface
{
    /**
     * Return an array of words to use for the fake text.
     *
     * @return array
     */
    public function getWordList(): array;
}