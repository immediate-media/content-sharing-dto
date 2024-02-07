<?php

namespace Image;

use ImmediateMedia\ContentSharingDto\Image\ImageDTO;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use PHPUnit\Framework\TestCase;

class ImageDTOTest extends TestCase
{
    public function testImageDtoWithValidData(): void
    {
        $drm = new DRM(DRM::GREEN, 'notes', 'creator', 'agency', 'damId');
        $image = new Image('url', 'alt', 'title', 100, 100, $drm);
        $imageDTO = new ImageDTO();
        $imageDTO->setImage($image);

        $this->assertEquals($image, $imageDTO->getImage());
    }

    public function testImageDtoMapsFromJsonCorrectly(): void
    {
        $jsonData = json_encode([
            'image' => [
                'url' => 'url',
                'alt' => 'alt',
                'title' => 'title',
                'width' => 100,
                'height' => 100,
                'drm' => [
                    'status' => DRM::GREEN,
                    'notes' => 'notes',
                    'creator' => 'creator',
                    'agency' => 'agency',
                    'damId' => 'damId'
                ],
                'isUpscaled' => false,
                'srcImage' => '',
                'exif' => [],
                'labels' => [],
                'objects' => []
            ]
        ]);

        $imageDTO = new ImageDTO();
        $imageDTO->map($jsonData);

        $this->assertEquals('url', $imageDTO->getImage()->getUrl());
        $this->assertEquals('alt', $imageDTO->getImage()->getAlt());
        $this->assertEquals('title', $imageDTO->getImage()->getTitle());
        $this->assertEquals(100, $imageDTO->getImage()->getWidth());
        $this->assertEquals(100, $imageDTO->getImage()->getHeight());
        $this->assertEquals(DRM::GREEN, $imageDTO->getImage()->getDrm()->getStatus());
    }

    public function testImageDtoToJson(): void
    {
        $drm = new DRM(DRM::GREEN, 'notes', 'creator', 'agency', 'damId');
        $image = new Image('url', 'alt', 'title', 100, 100, $drm);
        $imageDTO = new ImageDTO();
        $imageDTO->setImage($image);

        $jsonData = $imageDTO->toJson();
        $data = json_decode($jsonData, true);

        $this->assertEquals('url', $data['image']['url']);
        $this->assertEquals('alt', $data['image']['alt']);
        $this->assertEquals('title', $data['image']['title']);
        $this->assertEquals(100, $data['image']['width']);
        $this->assertEquals(100, $data['image']['height']);
        $this->assertEquals(DRM::GREEN, $data['image']['drm']['status']);
    }
}