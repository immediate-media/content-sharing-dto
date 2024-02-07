<?php

namespace ImmediateMedia\ContentSharingDto\Article;

use ImmediateMedia\ContentSharingDto\DTO;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;

/**
 * Class ArticleDTO
 * @package ImmediateMedia\ContentSharingDto\Article
 */
class ArticleDTO extends DTO
{

    // Bump this version when you make a breaking change to the DTO
    public string $ARTICLE_DTO_VERSION = '2.0.0';

    public string $type = 'article';

    public Image $heroImage;
    public Image $thumbnailImage;

    public string $text;
    public string $html;
    public string $markdown;
    public array $embedImages = [];

    protected array $validators = ['heroImage', 'thumbnailImage', 'tags', 'categories',  'slug','html'];

    public function getHeroImage(): Image
    {
        return $this->heroImage;
    }

    public function setHeroImage(Image $heroImage): void
    {
        $this->heroImage = $heroImage;
    }

    public function getThumbnailImage(): Image
    {
        return $this->thumbnailImage;
    }

    public function setThumbnailImage(Image $thumbnailImage): void
    {
        $this->thumbnailImage = $thumbnailImage;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getHtml(): string
    {
        return $this->html;
    }

    public function setHtml(string $html): void
    {
        $this->html = $html;
        $this->setText(strip_tags($html));
    }

    public function getMarkdown(): string
    {
        return $this->markdown;
    }

    public function setMarkdown(string $markdown): void
    {
        $this->markdown = $markdown;
    }

    public function getEmbedImages(): array
    {
        return $this->embedImages;
    }

    public function setEmbedImage(Image $image): void
    {
        $this->embedImages[] = $image;
    }




    /**
     * Map JSON Object to ArticleDTO
     * @param string $jsonData ArticleJson
     * @throws \JsonException
     */
    public function map(string $jsonData) : void
    {
        parent::map($jsonData);
        $data = json_decode($jsonData, false, 512, JSON_THROW_ON_ERROR);

        $this->setHeroImage(new Image(url: $data->heroImage->url, alt: $data->heroImage->alt,
            title: $data->heroImage->title,
            width: $data->heroImage->width,
            height: $data->heroImage->height,
            drm: new DRM(status: $data->heroImage->drm->status, notes: $data->heroImage->drm->notes,
                creator: $data->heroImage->drm->creator, agency: $data->heroImage->drm->agency,
                damId: $data->heroImage->drm->damId ?? ''),
            isUpscaled: $data->heroImage->isUpscaled ?? false,
            srcImage: $data->heroImage->srcImage ?? '',
            exif: $data->heroImage->exif ?? [],
            labels: $data->heroImage->labels ?? [],
            objects: $data->heroImage->objects ?? []
        ));

        $this->setThumbnailImage(new Image(url: $data->thumbnailImage->url, alt: $data->thumbnailImage->alt,
            title: $data->thumbnailImage->title,
            width: $data->thumbnailImage->width,
            height: $data->thumbnailImage->height,
            drm: new DRM(status: $data->thumbnailImage->drm->status, notes: $data->thumbnailImage->drm->notes,
                creator: $data->thumbnailImage->drm->creator, agency: $data->thumbnailImage->drm->agency,
                damId: $data->thumbnailImage->drm->damId ?? ''),
            isUpscaled: $data->thumbnailImage->isUpscaled ?? false,
            srcImage: $data->thumbnailImage->srcImage ?? '',
            exif: $data->thumbnailImage->exif ?? [],
            labels: $data->thumbnailImage->labels ?? [],
            objects: $data->thumbnailImage->objects ?? []
        ));

        if(isset($data->html)) {
            $this->setHtml($data->html);
        }

        if(isset($data->text)) {
            $this->setText($data->text);
        }

        if(isset($data->markdown)) {
            $this->setMarkdown($data->markdown);
        }

        if(isset($data->embedImages)) {
            foreach ($data->embedImages as $image)
            $this->setEmbedImage(new Image( $image->url, $image->alt, $image->title, $image->width, $image->height,
                new DRM( $image->drm->status, $image->drm->notes, $image->drm->creator, $image->drm->agency, $image->drm->damId),
                $image->isUpscaled, $image->srcImage
            ));
        }

    }



}