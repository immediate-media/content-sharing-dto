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

        $articleDTO->setHeroImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Hero Image',
            title: 'Image title',
            width: 800, height: 600,
            drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '123')));

        $articleDTO->setThumbnailImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Thumb Image',
            title: 'Image title',
            width: 80, height: 60,
            drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '124')));

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

        $this->assertEquals(800, $articleDTO->getHeroImage()->getWidth());
        $this->assertEquals(600, $articleDTO->getHeroImage()->getHeight());

        $this->assertEquals(80, $articleDTO->getThumbnailImage()->getWidth());
        $this->assertEquals(60, $articleDTO->getThumbnailImage()->getHeight());

        $this->assertEquals(DRM::GREEN, $articleDTO->getHeroImage()->getDrm()->getStatus());
        $this->assertEquals('Free to use worldwide', $articleDTO->getHeroImage()->getDrm()->getNotes());

        $this->assertEquals(DRM::YELLOW, $articleDTO->getThumbnailImage()->getDrm()->getStatus());
        $this->assertEquals('Restricted to UK only', $articleDTO->getThumbnailImage()->getDrm()->getNotes());

        $this->assertEquals('Copyright Holder', $articleDTO->getHeroImage()->getDrm()->getCreator());
        $this->assertEquals('Copyright Agency', $articleDTO->getHeroImage()->getDrm()->getAgency());

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
        $articleDTO->setHtml('<p>Example Content</p>');

        $this->assertEquals('<p>Example Content</p>', $articleDTO->getHtml());
        $this->assertEquals(strip_tags('<p>Example Content</p>'), $articleDTO->getText());

    }


    public function testEmbedImages()
    {
        $articleDTO = new ArticleDTO();
        $articleDTO->setEmbedImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Embed Image',
            title: 'Image title',
            width: 800, height: 600,
            drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Creator', agency: 'Agency', damId: '123')));

        $this->assertEquals('https://www.example.com/image.jpg', $articleDTO->getEmbedImages()[0]->url);
        $this->assertEquals('Embed Image', $articleDTO->getEmbedImages()[0]->alt);
        $this->assertEquals('Image title', $articleDTO->getEmbedImages()[0]->title);
        $this->assertEquals(800, $articleDTO->getEmbedImages()[0]->getWidth());
        $this->assertEquals(600, $articleDTO->getEmbedImages()[0]->getHeight());
        $this->assertEquals(DRM::GREEN, $articleDTO->getEmbedImages()[0]->getDrm()->getStatus());
        $this->assertEquals('Free to use worldwide', $articleDTO->getEmbedImages()[0]->getDrm()->getNotes());
        $this->assertEquals('Creator', $articleDTO->getEmbedImages()[0]->getDrm()->getCreator());
        $this->assertEquals('Agency', $articleDTO->getEmbedImages()[0]->getDrm()->getAgency());
        $this->assertEquals('123', $articleDTO->getEmbedImages()[0]->getDrm()->getDamId());


    }

    public function testArticleMapper()
    {
        $jsonData = '{"BASE_DTO_VERSION":"1.0.5","type":"article","trackingId":"CS-2d5bf4a54bd6a70411bbe0fd0eea85fc","clientRef":"ABC123","title":"Example Article Title","siteName":"Good News Site","url":"https:\/\/www.example.com\/recipe","slug":"example-article-slug","description":"Example Article Description","publishedDate":"2023-02-08T15:00:39+00:00","updatedDate":"2023-02-08T17:00:39+00:00","locale":"en","drm":{"status":1,"notes":"Article can be used Worldwide","creator":"unknown","agency":"unknown","damId":""},"author":{"name":"Firstname Lastname","email":"example@email.com","url":"https:\/\/www.example.com","image":"https:\/\/www.example.com\/image.jpg"},"heroImage":{"url":"https:\/\/www.example.com\/image.jpg","alt":"Hero Image","title":"Image title","width":800,"height":600,"isUpscaled":false,"srcImage":"","exif":[],"labels":[],"objects":[],"drm":{"status":1,"notes":"Free to use worldwide","creator":"Copyright Holder","agency":"Copyright Agency","damId":"12345"}},"thumbnailImage":{"url":"https:\/\/www.example.com\/image.jpg","alt":"Thumb Image","title":"Image title","width":80,"height":60,"isUpscaled":false,"srcImage":"","exif":[],"labels":[],"objects":[],"drm":{"status":2,"notes":"Restricted to UK only","creator":"Copyright Holder","agency":"Copyright Agency","damId":"12346"}},"tags":[{"name":"article tag 1","slug":"article-tag-1","notes":"optional tag notes"},{"name":"article tag 2","slug":"article-tag-2","notes":"optional tag notes"}],"categories":[{"name":"TV","slug":"tv","notes":"optional category notes"},{"name":"News","slug":"news","notes":"optional category notes"}],"ARTICLE_DTO_VERSION":"1.0.1","text":"Example Article Body with full markup","html":"<p>Example Article Body with full markup<\/p>","embedImages":[{"url":"https:\/\/www.example.com\/image.jpg","alt":"Article Image","title":"Article title","width":800,"height":600,"isUpscaled":false,"srcImage":"","exif":[],"labels":[],"objects":[],"drm":{"status":1,"notes":"Free to use worldwide","creator":"Copyright Holder","agency":"Copyright Agency","damId":"12345"}}]}';
        $articleDTO = new ArticleDTO();
        $articleDTO->map($jsonData);
        $this->assertEquals($jsonData, $articleDTO->toJson());
    }

}
