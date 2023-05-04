<?php

namespace ImmediateMedia\ContentSharingDto\Tests;

use ImmediateMedia\ContentSharingDto\Article\ArticleDTO;
use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\Tag;

use PHPUnit\Framework\TestCase;

class ArticleDTOTest extends TestCase
{

    public function testCoreMetaData()
    {

        $articleDTO = new ArticleDTO();
        $articleDTO->setAuthor(new Author(name: 'Firstname Lastname', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
        $articleDTO->setClientRef('ABC123');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Can be used Worldwide'));
        $articleDTO->setLocale('en');
        $articleDTO->setSlug('example-recipe-slug');
        $articleDTO->setSiteName('Food Website');
        $articleDTO->setPublishedDate('2023-02-08T15:00:39+00:00');
        $articleDTO->setUpdatedDate('2023-02-08T17:00:39+00:00');
        $articleDTO->setTitle('Example Recipe');
        $articleDTO->setDescription('Example Recipe Description');
        $articleDTO->setUrl('https://www.example.com/recipe');
        $articleDTO->setHeroImage(new Image(url: 'https://www.example.com/image.jpg', alt: 'Hero Image', title: 'Image title', drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide')));
        $articleDTO->setThumbnailImage(new Image(url: 'https://www.example.com/image.jpg', alt: 'Thumb Image', title: 'Image title', drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only')));
        $articleDTO->setTags(new Tag(name: 'first tag', slug: 'first-tag',notes: 'first tag notes'));
        $articleDTO->setTags(new Tag(name: 'second tag', slug: 'second-tag', notes: 'second tag notes'));
        $articleDTO->setCategories(new Category(name: 'Recipes', slug: 'recipes-slug', notes: 'category notes'));
        $articleDTO->setCategories(new Category(name: 'Food', slug: 'food-slug', notes: 'category notes'));


        $this->assertEquals('ABC123', $articleDTO->getClientRef());
        $this->assertEquals('en', $articleDTO->getLocale());
        $this->assertEquals('example-recipe-slug', $articleDTO->getSlug());

        $this->assertEquals('Firstname Lastname', $articleDTO->getAuthor()->getName());
        $this->assertEquals('example@email.com', $articleDTO->getAuthor()->getEmail());

        $this->assertEquals('Food Website', $articleDTO->getSiteName());
        $this->assertEquals('2023-02-08T15:00:39+00:00', $articleDTO->getPublishedDate());
        $this->assertEquals('2023-02-08T17:00:39+00:00', $articleDTO->getUpdatedDate());
        $this->assertEquals('Example Recipe', $articleDTO->getTitle());
        $this->assertEquals('Example Recipe Description', $articleDTO->getDescription());
        $this->assertEquals('https://www.example.com/recipe', $articleDTO->getUrl());

        $this->assertEquals('https://www.example.com/image.jpg', $articleDTO->getHeroImage()->url);
        $this->assertEquals('https://www.example.com/image.jpg', $articleDTO->getThumbnailImage()->url);

        $this->assertEquals(DRM::GREEN, $articleDTO->getHeroImage()->getDrm()->getStatus());
        $this->assertEquals('Free to use worldwide', $articleDTO->getHeroImage()->getDrm()->getNotes());

        $this->assertEquals(DRM::YELLOW, $articleDTO->getThumbnailImage()->getDrm()->getStatus());
        $this->assertEquals('Restricted to UK only', $articleDTO->getThumbnailImage()->getDrm()->getNotes());

        $this->assertEquals('first tag', $articleDTO->getTags()[0]->getName());
        $this->assertEquals('first-tag', $articleDTO->getTags()[0]->getSlug());
        $this->assertEquals('first tag notes', $articleDTO->getTags()[0]->getNotes());

        $this->assertEquals('second tag', $articleDTO->getTags()[1]->getName());
        $this->assertEquals('second-tag', $articleDTO->getTags()[1]->getSlug());
        $this->assertEquals('second tag notes', $articleDTO->getTags()[1]->getNotes());

        $this->assertEquals('Recipes', $articleDTO->getCategories()[0]->getName());
        $this->assertEquals('recipes-slug', $articleDTO->getCategories()[0]->getSlug());
        $this->assertEquals('category notes', $articleDTO->getCategories()[0]->getNotes());

    }


    public function testAddContent()
    {
        $articleDTO = new ArticleDTO();
        $articleDTO->setContentHtml('<p>Example Content</p>');
        $articleDTO->setContentText('Example Content');

        $this->assertEquals('<p>Example Content</p>', $articleDTO->getContentHtml());
        $this->assertEquals('Example Content', $articleDTO->getContentText());

    }

}
