<?php

namespace ImmediateMedia\ContentSharingDto\Image;

use ImmediateMedia\ContentSharingDto\DTO;
use ImmediateMedia\ContentSharingDto\Generic\Image;

class ImageDTO extends DTO
{
    public string $IMAGE_DTO_VERSION = '2.0.0';
    public string $type = 'image';

    public Image $image;

    protected array $validators = ['image'];

    public function getImage(): Image
    {
        return $this->image;
    }

    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

    public function map(string $jsonData): void
    {
        parent::map($jsonData);
        $data = json_decode($jsonData, false, 512, JSON_THROW_ON_ERROR);

        $this->setImage(new Image(
            url: $data->image->url,
            alt: $data->image->alt,
            title: $data->image->title,
            width: $data->image->width,
            height: $data->image->height,
            drm: $data->image->drm,
            isUpscaled: $data->image->isUpscaled,
            srcImage: $data->image->srcImage,
            exif: $data->image->exif,
            labels: $data->image->labels,
            objects: $data->image->objects
        ));
    }
}