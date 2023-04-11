<?php

namespace ImmediateMedia\ContentSharingDto;

use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\Tag;


abstract class BaseDTO
{
    // Bump this version when you make a breaking change to the DTO
    public const DTO_VERSION = '1.0.0';

    public string $DTO_VERSION = self::DTO_VERSION;

    public string $type = 'base';

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

    public function getLocale(): string
    {
        return $this->locale;
    }

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
        $this->publishedDate = $publishedDate;
    }

    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(string $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

    public function toJSON($flags = 0): string
    {
        return json_encode($this, $flags);
    }

}