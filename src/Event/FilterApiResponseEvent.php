<?php
/**
 * Created by Michał Nowacki
 * Date: 24/11/2019
 * Time: 15:13
 * Filename: FilterApiResponseEvent.php
 */

namespace KnpU\LoremIpsumBundle\Event;


//use Symfony\Component\EventDispatcher\Event;
use Symfony\Contracts\EventDispatcher\Event;

class FilterApiResponseEvent extends Event
{
    /**
     * @var array
     */
    private $data;

    /**
     * FilterApiResponseEvent constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }


}