<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

final class ArtistOutput
{
    /**
     * @Groups("artist_read")
     */
    public $id;
    /**
     * @Groups({"artist_read", "album_read", "user_read"})
     */
    public $name;
    /**
     * @Groups({"artist_read", "user_read"})
     */
    public $startYear;
    /**
     * @Groups("artist_read")
     */
    public $numberOfAlbums;
    /**
     * @Groups("artist_read")
     */
    public $numberOfFans;
    /**
     * @Groups("artist_read")
     */
    public $styles;
}
