<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\UserOutput;
use App\Entity\User;
use DateTime;

final class UserOutputDataTransformer implements DataTransformerInterface
{
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return UserOutput::class === $to && $data instanceof User;
    }

    public function transform($object, string $to, array $context = [])
    {
        if (!$object instanceof User) {
            return;
        }

        $output = new UserOutput();

        $output->id = $object->getId();
        $output->email = $object->getEmail();
        $output->numberOfFavoriteArtists = $object->getArtists()->count();
        $output->favoriteArtists = $object->getArtists();

        return $output;
    }
}
