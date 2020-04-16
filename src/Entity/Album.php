<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"= {"album_read"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"name" : "ipartial"})
 * @ApiFilter(RangeFilter::class, properties={"releaseYear"})
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album extends AbstractEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("album_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("album_read")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups("album_read")
     */
    private $releaseYear;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="albums")
     * @Groups("album_read")
     */
    private $artist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(int $releaseYear): self
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}
