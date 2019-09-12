<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A person (alive, dead, undead, or fictional).
 *
 * @see http://schema.org/Person Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Person")
 */
class Person
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null Family name. In the U.S., the last name of an Person. This can be used along with givenName instead of the name property.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/familyName")
     */
    private $familyName;

    /**
     * @var string|null Given name. In the U.S., the first name of a Person. This can be used along with familyName instead of the name property.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/givenName")
     */
    private $givenName;

    /**
     * @var string|null an additional name for a Person, can be used for a middle name
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/additionalName")
     */
    private $additionalName;

    /**
     * @var Collection<Book>|null
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Book")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true)})
     */
    private $books;

    /**
     * @var Collection<Review>|null
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Review")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true)})
     */
    private $reviews;

    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFamilyName(?string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setGivenName(?string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setAdditionalName(?string $additionalName): void
    {
        $this->additionalName = $additionalName;
    }

    public function getAdditionalName(): ?string
    {
        return $this->additionalName;
    }

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }

    public function removeBook(Book $book): void
    {
        $this->books->removeElement($book);
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addReview(Review $review): void
    {
        $this->reviews[] = $review;
    }

    public function removeReview(Review $review): void
    {
        $this->reviews->removeElement($review);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }
}
