<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A review of a book
 *
 * @ORM\Entity
 *
 * @ApiResource
 */
class Review
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
     * @var int Rating of this review between 0 and 5
     *
     * @ORM\Column(type="smallint")
     *
     * @Assert\Range(min=0, max=5)
     */
    public $rating;

    /**
     * @var string Body of the review
     *
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     */
    public $body;

    /**
     * @var string Author name of review
     *
     * @ORM\Column
     *
     * @Assert\NotBlank
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
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     *
     * @Assert\NotNull
     */
    public $book;

    public function getId(): ?int
    {
        return $this->id;
    }
}