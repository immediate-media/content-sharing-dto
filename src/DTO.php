<?php

namespace ImmediateMedia\ContentSharingDto;

use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\Tag;

/**
 * Class DTO
 * @package ImmediateMedia\ContentSharingDto
 */
abstract class DTO
{
    // Bump this version when you make a breaking change to the DTO
    public string $BASE_DTO_VERSION = '2.0.0';

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
    public array $tags = [];
    public array $categories = [];

    protected array $baseValidators = ['clientRef', 'title', 'siteName', 'url', 'description', 'publishedDate',
        'updatedDate', 'locale', 'drm', 'author'];

    public function validate(): bool
    {
        $fields = array_merge($this->baseValidators, $this->validators);

        foreach($fields as $field) {
            if (empty($this->$field)) {
                throw new \Exception("DTO validation error :: Field $field is empty");
            }
        }

        return true;
    }

    public function getType(): string
    {
        return $this->type;
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
        $this->setDrm(new DRM(status: $data->drm->status, notes: $data->drm->notes));
        $this->setLocale($data->locale);
        $this->setSlug($data->slug);
        $this->setSiteName($data->siteName);
        $this->setPublishedDate($data->publishedDate);
        $this->setUpdatedDate($data->updatedDate);
        $this->setTitle($data->title);
        $this->setDescription($data->description);
        $this->setUrl($data->url);

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