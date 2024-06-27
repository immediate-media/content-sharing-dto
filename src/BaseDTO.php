<?php

namespace ImmediateMedia\ContentSharingDto;

use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\Tag;

/**
 * Class BaseDTO
 * @package ImmediateMedia\ContentSharingDto
 */
abstract class BaseDTO
{
    // Bump this version when you make a breaking change to the DTO
    public string $BASE_DTO_VERSION = '1.0.5';

    public string $type = 'base';
    public string $trackingId;
    public int $version = 1;
    public string $clientRef;
    public string $title;
    public string $siteName;
    public string $url;

    public string $slug;
    public string $description;
    public string $publishedDate;
    public string $updatedDate;
    public string $locale;

    public DRM $drm;
    public Author $author;
    public Image $heroImage;
    public Image $thumbnailImage;

    public array $tags = [];
    public array $categories = [];

    protected array $baseValidators = ['clientRef', 'title', 'siteName', 'url', 'slug', 'description', 'publishedDate',
        'updatedDate', 'locale', 'drm', 'author', 'heroImage', 'thumbnailImage', 'tags', 'categories'];

    public function validate(): bool
    {
        $fields = array_merge($this->baseValidators, $this->validators);

        foreach($fields as $field) {
            if (empty($this->$field)) {
                throw new \Exception("Field $field is empty");
            }
        }

        return true;
    }

    /**
     * ISO 639-1 language code
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * ISO 639-1 language code
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getDrm(): DRM
    {
        return $this->drm;
    }

    public function setDrm(DRM $drm): void
    {
        $this->drm = $drm;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(Category $categories): void
    {
        $this->categories[] = $categories;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(Tag $tags): void
    {
        $this->tags[] = $tags;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

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

    public function getClientRef(): string
    {
        return $this->clientRef;
    }

    public function setClientRef(string $clientRef): void
    {
        $this->clientRef = $clientRef;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSiteName(): string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): void
    {
        $this->siteName = $siteName;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
        $this->setTrackingId($url);
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    public function getPublishedDate(): string
    {
        return $this->publishedDate;
    }

    public function setPublishedDate(string $publishedDate): void
    {
        $this->publishedDate = date(DATE_W3C,strtotime($publishedDate));
    }

    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(string $updatedDate): void
    {
        $this->updatedDate = date(DATE_W3C,strtotime($updatedDate));
    }

    public function getTrackingId(): string
    {
        return $this->trackingId;
    }

    public function setTrackingId(string $url): void
    {
        $this->trackingId = 'CS-' . md5($url);
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }



    /**
     * Map JSON Object to BaseDTO
     * @param string $jsonData BaseJson
     * @throws \JsonException
     */
    public function map(string $jsonData): void
    {
        $data = json_decode($jsonData, false, 512, JSON_THROW_ON_ERROR);

        $this->setAuthor(new Author(name: $data->author->name, email: $data->author->email, url: $data->author->url, image: $data->author->image));
        $this->setClientRef($data->clientRef);
        $this->setVersion($data->version ?? 1);
        $this->setDrm(new DRM(status: $data->drm->status, notes: $data->drm->notes));
        $this->setLocale($data->locale);
        $this->setSlug($data->slug);
        $this->setSiteName($data->siteName);
        $this->setPublishedDate($data->publishedDate);
        $this->setUpdatedDate($data->updatedDate);
        $this->setTitle($data->title);
        $this->setDescription($data->description);
        $this->setUrl($data->url);

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
            objects: $data->heroImage->objects ?? [],
            assetId: $data->heroImage->assetId ?? '',
            isPlaceholder: $data->heroImage->isPlaceholder ?? false,
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
            objects: $data->thumbnailImage->objects ?? [],
            assetId: $data->thumbnailImage->assetId ?? '',
            isPlaceholder: $data->thumbnailImage->isPlaceholder ?? false,
        ));

        foreach($data->tags as $tag) {
            $this->setTags(new Tag(name: $tag->name, slug: $tag->slug, notes: $tag->notes));
        }

        foreach($data->categories as $category) {
            $this->setCategories(new Category(name: $category->name, slug: $category->slug, notes: $category->notes));
        }

    }

    public function toJSON($flags = 0): string
    {
        return json_encode($this, $flags);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

}