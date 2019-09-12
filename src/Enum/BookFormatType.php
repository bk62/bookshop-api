<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * The publication format of the book.
 *
 * @see http://schema.org/BookFormatType Documentation on Schema.org
 * @ApiResource(iri="http://schema.org/BookFormatType")
 */
class BookFormatType extends Enum
{
    /**
     * @var string book format: Ebook
     */
    const E_BOOK = 'http://schema.org/EBook';

    /**
     * @var string book format: Hardcover
     */
    const HARDCOVER = 'http://schema.org/Hardcover';

    /**
     * @var string book format: Paperback
     */
    const PAPERBACK = 'http://schema.org/Paperback';

    /**
     * @var string Book format: Audiobook. This is an enumerated value for use with the bookFormat property. There is also a type 'Audiobook' in the bib extension which includes Audiobook specific properties.
     */
    const AUDIOBOOK_FORMAT = 'http://schema.org/AudiobookFormat';

    /**
     * @var string|null the name of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/name")
     */
    private $name;

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
