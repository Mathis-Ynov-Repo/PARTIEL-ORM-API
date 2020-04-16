<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

final class UserOutput
{
    /**
     * @Groups("user_read")
     */
    public $id;
    /**
     * @Groups("user_read")
     */
    public $email;

    /**
     * @Groups("user_read")
     */
    public $numberOfFavoriteArtists;
    /**
     * @Groups("user_read")
     */
    public $favoriteArtists;
}
