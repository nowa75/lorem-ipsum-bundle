<?php
/**
 * Created by Michał Nowacki
 * Date: 24/11/2019
 * Time: 13:39
 * Filename: IpsumApiController.php
 */

namespace KnpU\LoremIpsumBundle\Controller;

use KnpU\LoremIpsumBundle\KnpUIpsum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IpsumApiController extends AbstractController
{
    /**
     * @var KnpUIpsum
     */
    private $knpUIpsum;

    /**
     * IpsumApiController constructor.
     */
    public function __construct(KnpUIpsum $knpUIpsum)
    {
        $this->knpUIpsum = $knpUIpsum;
    }

    public function index()
    {
        return $this->json([
            'paragraphs' => $this->knpUIpsum->getParagraphs(),
            'sentences' => $this->knpUIpsum->getSentences(),
        ]);
    }
}