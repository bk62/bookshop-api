<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * A book
 *
 * @ORM\Entity
 *
 * @ApiResource
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null ISBN or null
     *
     * @ORM\Column(nullable=true)
     */
    public $isbn;

    /**
     * @var string Title
     *
     * @ORM\Column
     */
    public $title;

    /**
     * @var string Description
     *
     * @ORM\Column(type="text")
     */
    public $description;

    /**
     * @var string Author name
     *
     * @ORM\Column
     */
    public $author;

    /**
     * @var \DateTimeInterface Publication date
     *
     * @ORM\Column(type="datetime")
     */
    public $publicationDate;

    /**
     * @var Review[] Available reviews
     *
     * @ORM\OneToMany(targetEntity="Review", mappedBy="book", cascade={"persist", "remove"})
     */
    public $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}