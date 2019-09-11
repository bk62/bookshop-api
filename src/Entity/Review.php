<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A review of a book
 *
 * @ORM\Entity
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
     */
    public $rating;

    /**
     * @var string Body of the review
     *
     * @ORM\Column(type="text")
     */
    public $body;

    /**
     * @var string Author name of review
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
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     */
    public $book;

    public function getId(): ?int
    {
        return $this->id;
    }
}