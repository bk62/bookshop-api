<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Enum\BookFormatType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * A book.
 *
 * @see http://schema.org/Book Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Book")
 * @ApiFilter(DateFilter::class, properties={"datePublished": DateFilter::EXCLUDE_NULL})
 * @ApiFilter(SearchFilter::class, properties={
 *     "isbn": "exact",
 *     "name": "ipartial",
 *     "genre": "ipartial",
 *     "keywords": "ipartial",
 *     "authors.givenName": "ipartial",
 *     "authors.familyName": "ipartial"
 * })
 * @ApiFilter(OrderFilter::class, properties={
 *     "id", "isbn", "datePublished"
 *  }, arguments={"orderParameterName"="order"})
 */
class Book
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
     * @var string|null the name of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string|null the edition of the book
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/bookEdition")
     */
    private $bookEdition;

    /**
     * @var string|null the format of the book
     *
     * @ORM\Column(nullable=true)
     * @ApiProperty(iri="http://schema.org/bookFormat")
     * @Assert\Choice(callback={"BookFormatType", "toArray"})
     */
    private $bookFormat;

    /**
     * @var string|null the ISBN of the book
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/isbn")
     * @Assert\Isbn
     */
    private $isbn;

    /**
     * @var Collection<Person> The author of this content or rating. Please note that author is special in that HTML 5 provides a special mechanism for indicating authorship via the rel tag. That is equivalent to this and may be used interchangeably.
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Person")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(nullable=false, unique=true)})
     * @ApiProperty(iri="http://schema.org/author")
     * @Assert\NotNull
     */
    private $authors;

    /**
     * @var \DateTimeInterface|null date of first broadcast/publication
     *
     * @ORM\Column(type="date", nullable=true)
     * @ApiProperty(iri="http://schema.org/datePublished")
     * @Assert\Date
     */
    private $datePublished;

    /**
     * @var string|null genre of the creative work, broadcast channel or group
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/genre")
     */
    private $genre;

    /**
     * @var string|null The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/inLanguage")
     */
    private $inLanguage;

    /**
     * @var string|null Keywords or tags used to describe this content. Multiple entries in a keywords list are typically delimited by commas.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/keywords")
     */
    private $keyword;

    /**
     * @var Organization|null the publisher of the creative work
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Organization")
     * @ApiProperty(iri="http://schema.org/publisher")
     */
    private $publisher;

    /**
     * @var Collection<Review>|null review of the item
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Review")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true)})
     * @ApiProperty(iri="http://schema.org/reviews")
     */
    private $reviews;

    /**
     * @var string|null a thumbnail image relevant to the Thing
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/thumbnailUrl")
     * @Assert\Url
     */
    private $thumbnailUrl;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setBookEdition(?string $bookEdition): void
    {
        $this->bookEdition = $bookEdition;
    }

    public function getBookEdition(): ?string
    {
        return $this->bookEdition;
    }

    public function setBookFormat(?string $bookFormat): void
    {
        $this->bookFormat = $bookFormat;
    }

    public function getBookFormat(): ?string
    {
        return $this->bookFormat;
    }

    public function setIsbn(?string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function addAuthor(Person $author): void
    {
        $this->authors[] = $author;
    }

    public function removeAuthor(Person $author): void
    {
        $this->authors->removeElement($author);
    }

    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function setDatePublished(?\DateTimeInterface $datePublished): void
    {
        $this->datePublished = $datePublished;
    }

    public function getDatePublished(): ?\DateTimeInterface
    {
        return $this->datePublished;
    }

    public function setGenre(?string $genre): void
    {
        $this->genre = $genre;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setInLanguage(?string $inLanguage): void
    {
        $this->inLanguage = $inLanguage;
    }

    public function getInLanguage(): ?string
    {
        return $this->inLanguage;
    }

    public function setKeyword(?string $keyword): void
    {
        $this->keyword = $keyword;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setPublisher(?Organization $publisher): void
    {
        $this->publisher = $publisher;
    }

    public function getPublisher(): ?Organization
    {
        return $this->publisher;
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

    public function setThumbnailUrl(?string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }
}
