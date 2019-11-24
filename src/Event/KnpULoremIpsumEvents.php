<?php
/**
 * Created by Michał Nowacki
 * Date: 24/11/2019
 * Time: 17:11
 * Filename: KnpULoremIpsumEvents.php
 */

namespace KnpU\LoremIpsumBundle\Event;
final class KnpULoremIpsumEvents
{
    /**
     * Called directly before the Lorem Ipsum API data is returned.
     *
     * Listeners have the opportunity to change that data.
     *
     * @Event("KnpU\LoremIpsumBundle\Event\FilterApiResponseEvent")
     */
    const FILTER_API = 'knpu_lorem_ipsum.filter_api';
}