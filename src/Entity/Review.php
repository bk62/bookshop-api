<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * A review of an item - for example, of a restaurant, movie, or store.
 *
 * @see http://schema.org/Review Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Review")
 * @ApiFilter(DateFilter::class, properties={"datePublished": DateFilter::EXCLUDE_NULL})
 * @ApiFilter(SearchFilter::class, properties={
 *     "author": "ipartial",
 *     "itemReviewed": "exact",
 *     "itemReviewed.isbn": "exact",
 *     "itemReviewed.name": "ipartial"
 * })
 * @ApiFilter(NumericFilter::class, properties={"reviewRating"})
 * @ApiFilter(RangeFilter::class, properties={"reviewRating"})
 * @ApiFilter(OrderFilter::class, properties={
 *     "id", "datePublished", "itemReviewed.id", "itemReviewed.datePublished"
 * }, arguments={"orderParameterName"="order"})
 */
class Review
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
     * @var Book the item that is being reviewed/rated
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Book")
     * @ORM\JoinColumn(nullable=false)
     * @ApiProperty(iri="http://schema.org/itemReviewed")
     * @Assert\NotNull
     */
    private $itemReviewed;

    /**
     * @var string|null the actual body of the review
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/reviewBody")
     */
    private $reviewBody;

    /**
     * @var float|null The rating given in this review. Note that reviews can themselves be rated. The ```reviewRating``` applies to rating given by the review. The \[\[aggregateRating\]\] property applies to the review itself, as a creative work.
     *
     * @ORM\Column(type="smallint", nullable=true)
     * @ApiProperty(iri="http://schema.org/reviewRating")
     * @Assert\Range(min=0, max=5)
     */
    private $reviewRating;

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
     * @var Organization the publisher of the creative work
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Organization")
     * @ORM\JoinColumn(nullable=false)
     * @ApiProperty(iri="http://schema.org/publisher")
     * @Assert\NotNull
     */
    private $publisher;

    /**
     * @var string|null the textual content of this CreativeWork
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/text")
     * @Assert\NotBlank
     */
    private $text;

    /**
     * @var float|null the version of the CreativeWork embodied by a specified resource
     *
     * @ORM\Column(type="float", nullable=true)
     * @ApiProperty(iri="http://schema.org/version")
     */
    private $version;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setItemReviewed(Book $itemReviewed): void
    {
        $this->itemReviewed = $itemReviewed;
    }

    public function getItemReviewed(): Book
    {
        return $this->itemReviewed;
    }

    public function setReviewBody(?string $reviewBody): void
    {
        $this->reviewBody = $reviewBody;
    }

    public function getReviewBody(): ?string
    {
        return $this->reviewBody;
    }

    /**
     * @param float|null $reviewRating
     */
    public function setReviewRating($reviewRating): void
    {
        $this->reviewRating = $reviewRating;
    }

    /**
     * @return float|null
     */
    public function getReviewRating()
    {
        return $this->reviewRating;
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

    public function setPublisher(Organization $publisher): void
    {
        $this->publisher = $publisher;
    }

    public function getPublisher(): Organization
    {
        return $this->publisher;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param float|null $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }

    /**
     * @return float|null
     */
    public function getVersion()
    {
        return $this->version;
    }
}
