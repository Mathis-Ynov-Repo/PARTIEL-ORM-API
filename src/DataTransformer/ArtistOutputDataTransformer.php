<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\ArtistOutput;

use App\Entity\Artist;

final class ArtistOutputDataTransformer implements DataTransformerInterface
{
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ArtistOutput::class === $to && $data instanceof Artist;
    }

    public function transform($object, string $to, array $context = [])
    {
        if (!$object instanceof Artist) {
            return;
        }

        $output = new ArtistOutput();

        $output->id = $object->getId();
        $output->name = $object->getName();
        $output->startYear = $object->getStartYear();
        $output->numberOfAlbums = $object->getAlbums()->count();
        $output->styles = $object->getStyles();
        $output->numberOfFans = $object->getUsers()->count();

        return $output;
    }
}
