<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\Isbn
     */
    public $isbn;

    /**
     * @var string Title
     *
     * @ORM\Column
     *
     * @Assert\NotBlank
     */
    public $title;

    /**
     * @var string Description
     *
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     */
    public $description;

    /**
     * @var string Author name
     *
     * @ORM\Column
     *
     * @Assert\NotBlank
     *
     */
    public $author;

    /**
     * @var \DateTimeInterface Publication date
     *
     * @ORM\Column(type="datetime")
     *
     * @Assert\NotNull
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