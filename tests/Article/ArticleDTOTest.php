<?php

namespace ImmediateMedia\ContentSharingDto\Tests;

use ImmediateMedia\ContentSharingDto\Article\ArticleDTO;
use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\Tag;
use ImmediateMedia\ContentSharingDto\Generic\SEO;
use ImmediateMedia\ContentSharingDto\Generic\OpenGraph;

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
        $articleDTO = new ArticleDTO();
        $articleDTO->setVersion(2);
        $articleDTO->setTrackingId('CS-2d5bf4a54bd6a70411bbe0fd0eea85fc');
        $articleDTO->setClientRef('ABC123');
        $articleDTO->setTitle('Example Article Title');
        $articleDTO->setSiteName('Good News Site');
        $articleDTO->setUrl('https://www.example.com/recipe');
        $articleDTO->setSlug('example-article-slug');
        $articleDTO->setDescription('Example Article Description');
        $articleDTO->setPublishedDate('2023-02-08T15:00:39+00:00');
        $articleDTO->setUpdatedDate('2023-02-08T17:00:39+00:00');
        $articleDTO->setLocale('en');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Article can be used Worldwide', creator: 'unknown', agency: 'unknown', damId: ''));
        $articleDTO->setAuthor(new Author(name: 'Firstname Lastname', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
        $articleDTO->setHeroImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Hero Image',
            title: 'Image title',
            width: 800, height: 600,
            drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '12345'),
            isUpscaled: false,
            srcImage: '',
            exif: [],
            labels: [],
            objects: [],
            assetId: 'CS-23839734',
            isPlaceholder: true
        ));
        $articleDTO->setThumbnailImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Thumb Image',
            title: 'Image title',
            width: 80, height: 60,
            drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '12346'),
            isUpscaled: false,
            srcImage: '',
            exif: [],
            labels: [],
            objects: []
        ));
        $articleDTO->setTags(new Tag(name: 'article tag 1', slug: 'article-tag-1', notes: 'optional tag notes'));
        $articleDTO->setTags(new Tag(name: 'article tag 2', slug: 'article-tag-2', notes: 'optional tag notes'));
        $articleDTO->setCategories(new Category(name: 'TV', slug: 'tv', notes: 'optional category notes'));
        $articleDTO->setCategories(new Category(name: 'News', slug: 'news', notes: 'optional category notes'));
        $articleDTO->setText('Example Article Body with full markup');
        $articleDTO->setHtml('<p>Example Article Body with full markup</p>');
        $articleDTO->setEmbedImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Article Image',
            title: 'Article title',
            width: 800, height: 600,
            drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '12345'),
            isUpscaled: false,
            srcImage: '',
            exif: [],
            labels: [],
            objects: [],
            assetId: 'CS-23839734-embed',
            isPlaceholder: false
        ));

        $jsonData = $articleDTO->toJson();
        $mappedArticleDTO = new ArticleDTO();
        $mappedArticleDTO->map($jsonData);

        $this->assertEquals($articleDTO, $mappedArticleDTO);
    }

    public function testSEOMapping()
    {
        $articleDTO = new ArticleDTO();
        // Set mandatory fields for ArticleDTO
        $articleDTO->setClientRef('SEO_CLIENT_REF');
        $articleDTO->setTitle('SEO Test Article');
        $articleDTO->setSiteName('SEO Test Site');
        $articleDTO->setUrl('https://www.example.com/seo-test');
        $articleDTO->setSlug('seo-test-slug');
        $articleDTO->setDescription('SEO test description');
        $articleDTO->setPublishedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setUpdatedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setLocale('en-GB');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Test DRM'));
        $articleDTO->setAuthor(new Author(name: 'Test Author', email: 'test@example.com', url: 'https://example.com/author', image: 'https://example.com/author.jpg'));
        $articleDTO->setCategories(new Category(name: 'Test Category', slug: 'test-category', notes: 'Test category notes'));
        // It is important to set hero and thumbnail images as they are used in the base DTO mapping logic
        $articleDTO->setHeroImage(new Image(url: 'https://example.com/hero.jpg', alt: 'Hero', title: 'Hero Title', width: 100, height: 100, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));
        $articleDTO->setThumbnailImage(new Image(url: 'https://example.com/thumb.jpg', alt: 'Thumb', title: 'Thumb Title', width: 50, height: 50, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));


        $openGraphImage = new Image(
            url: 'https://www.example.com/og-image.jpg',
            alt: 'OpenGraph Image Alt',
            title: 'OpenGraph Image Title',
            width: 1200,
            height: 630,
            drm: new DRM(status: DRM::GREEN, notes: 'OG Image DRM')
        );
        $openGraph = new OpenGraph(
            title: 'Test OpenGraph Title',
            description: 'Test OpenGraph Description',
            image: $openGraphImage
        );

        $seo = new SEO(
            metaTitle: 'Test Meta Title',
            metaDescription: 'Test Meta Description',
            openGraph: $openGraph
        );

        $articleDTO->setSEO($seo);

        $jsonData = $articleDTO->toJson();
        $mappedArticleDTO = new ArticleDTO();
        $mappedArticleDTO->map($jsonData);

        $this->assertNotNull($mappedArticleDTO->getSEO(), "SEO object should be populated");
        $this->assertEquals('Test Meta Title', $mappedArticleDTO->getSEO()->getMetaTitle());
        $this->assertEquals('Test Meta Description', $mappedArticleDTO->getSEO()->getMetaDescription());

        $mappedOpenGraph = $mappedArticleDTO->getSEO()->getOpenGraph();
        $this->assertNotNull($mappedOpenGraph, "OpenGraph object should be populated in SEO");
        $this->assertEquals('Test OpenGraph Title', $mappedOpenGraph->getTitle());
        $this->assertEquals('Test OpenGraph Description', $mappedOpenGraph->getDescription());
        $this->assertNotNull($mappedOpenGraph->getImage(), "Image object should be populated in OpenGraph");
        $this->assertEquals('https://www.example.com/og-image.jpg', $mappedOpenGraph->getImage()->url);
        $this->assertEquals('OpenGraph Image Alt', $mappedOpenGraph->getImage()->alt);
        $this->assertEquals('OpenGraph Image Title', $mappedOpenGraph->getImage()->title);
        $this->assertEquals(1200, $mappedOpenGraph->getImage()->width);
        $this->assertEquals(630, $mappedOpenGraph->getImage()->height);
        $this->assertEquals(DRM::RED, $mappedOpenGraph->getImage()->getDrm()->getStatus());
        $this->assertEquals('OpenGraph Image DRM', $mappedOpenGraph->getImage()->getDrm()->getNotes());
    }

    public function testSEOMappingMissingSEO()
    {
        $articleDTO = new ArticleDTO();
        // Set mandatory fields for ArticleDTO
        $articleDTO->setClientRef('SEO_MISSING_CLIENT_REF');
        $articleDTO->setTitle('SEO Missing Test Article');
        $articleDTO->setSiteName('SEO Missing Test Site');
        $articleDTO->setUrl('https://www.example.com/seo-missing-test');
        $articleDTO->setSlug('seo-missing-test-slug');
        $articleDTO->setDescription('SEO missing test description');
        $articleDTO->setPublishedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setUpdatedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setLocale('en-GB');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Test DRM'));
        $articleDTO->setAuthor(new Author(name: 'Test Author', email: 'test@example.com', url: 'https://example.com/author', image: 'https://example.com/author.jpg'));
        $articleDTO->setCategories(new Category(name: 'Test Category', slug: 'test-category', notes: 'Test category notes'));
        $articleDTO->setHeroImage(new Image(url: 'https://example.com/hero.jpg', alt: 'Hero', title: 'Hero Title', width: 100, height: 100, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));
        $articleDTO->setThumbnailImage(new Image(url: 'https://example.com/thumb.jpg', alt: 'Thumb', title: 'Thumb Title', width: 50, height: 50, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));

        // SEO object is not set on $articleDTO

        $jsonData = $articleDTO->toJson();
        // Manually remove SEO from JSON to simulate it missing
        $dataArray = json_decode($jsonData, true);
        unset($dataArray['seo']);
        $jsonWithoutSEO = json_encode($dataArray);

        $mappedArticleDTO = new ArticleDTO();
        $mappedArticleDTO->map($jsonWithoutSEO);

        $this->assertNull($mappedArticleDTO->getSEO(), "SEO object should be null when missing from JSON");
    }

    public function testSEOMappingMissingOpenGraph()
    {
        $articleDTO = new ArticleDTO();
        // Set mandatory fields
        $articleDTO->setClientRef('OG_MISSING_CLIENT_REF');
        $articleDTO->setTitle('OG Missing Test Article');
        $articleDTO->setSiteName('OG Missing Test Site');
        $articleDTO->setUrl('https://www.example.com/og-missing-test');
        $articleDTO->setSlug('og-missing-test-slug');
        $articleDTO->setDescription('OG missing test description');
        $articleDTO->setPublishedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setUpdatedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setLocale('en-GB');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Test DRM'));
        $articleDTO->setAuthor(new Author(name: 'Test Author', email: 'test@example.com', url: 'https://example.com/author', image: 'https://example.com/author.jpg'));
        $articleDTO->setCategories(new Category(name: 'Test Category', slug: 'test-category', notes: 'Test category notes'));
        $articleDTO->setHeroImage(new Image(url: 'https://example.com/hero.jpg', alt: 'Hero', title: 'Hero Title', width: 100, height: 100, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));
        $articleDTO->setThumbnailImage(new Image(url: 'https://example.com/thumb.jpg', alt: 'Thumb', title: 'Thumb Title', width: 50, height: 50, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));

        // SEO is present, but OpenGraph is not explicitly set within SEO
        $seo = new SEO(
            metaTitle: 'Test Meta Title',
            metaDescription: 'Test Meta Description',
            openGraph: null
        );

        $articleDTO->setSEO($seo);

        $jsonData = $articleDTO->toJson();
        // Simulate OpenGraph missing in JSON, though PHP might make it null by default
        $dataArray = json_decode($jsonData, true);
        unset($dataArray['seo']['openGraph']);
        $jsonWithoutOpenGraph = json_encode($dataArray);


        $mappedArticleDTO = new ArticleDTO();
        $mappedArticleDTO->map($jsonWithoutOpenGraph);

        $this->assertNotNull($mappedArticleDTO->getSEO(), "SEO object should be populated");
        $this->assertEquals('Test Meta Title', $mappedArticleDTO->getSEO()->getMetaTitle());
        $this->assertEquals('Test Meta Description', $mappedArticleDTO->getSEO()->getMetaDescription());

        $mappedOpenGraph = $mappedArticleDTO->getSEO()->getOpenGraph();
        $this->assertNotNull($mappedOpenGraph, "OpenGraph object should still be created even if missing from JSON");
        $this->assertEquals('', $mappedOpenGraph->getTitle(), "OpenGraph title should be empty string when OG is missing");
        $this->assertEquals('', $mappedOpenGraph->getDescription(), "OpenGraph description should be empty string when OG is missing");
        $this->assertNull($mappedOpenGraph->getImage(), "OpenGraph image should be null when OG is missing");
    }

    public function testSEOMappingMissingOpenGraphImage()
    {
        $articleDTO = new ArticleDTO();
        // Set mandatory fields
        $articleDTO->setClientRef('OG_IMG_MISSING_CLIENT_REF');
        $articleDTO->setTitle('OG Image Missing Test Article');
        $articleDTO->setSiteName('OG Image Missing Test Site');
        $articleDTO->setUrl('https://www.example.com/og-image-missing-test');
        $articleDTO->setSlug('og-image-missing-test-slug');
        // ... (fill in other mandatory fields as in previous tests)
        $articleDTO->setDescription('OG image missing test description');
        $articleDTO->setPublishedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setUpdatedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setLocale('en-GB');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Test DRM'));
        $articleDTO->setAuthor(new Author(name: 'Test Author', email: 'test@example.com', url: 'https://example.com/author', image: 'https://example.com/author.jpg'));
        $articleDTO->setCategories(new Category(name: 'Test Category', slug: 'test-category', notes: 'Test category notes'));
        $articleDTO->setHeroImage(new Image(url: 'https://example.com/hero.jpg', alt: 'Hero', title: 'Hero Title', width: 100, height: 100, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));
        $articleDTO->setThumbnailImage(new Image(url: 'https://example.com/thumb.jpg', alt: 'Thumb', title: 'Thumb Title', width: 50, height: 50, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));

        $openGraph = new OpenGraph(
            title: 'Test OpenGraph Title',
            description: 'Test OpenGraph Description',
            image: null
        );

        $seo = new SEO(
            metaTitle: 'Test Meta Title',
            metaDescription: 'Test Meta Description',
            openGraph: $openGraph
        );
        $articleDTO->setSEO($seo);

        $jsonData = $articleDTO->toJson();
        // Simulate image missing in JSON
        $dataArray = json_decode($jsonData, true);
        unset($dataArray['seo']['openGraph']['image']);
        $jsonWithoutOpenGraphImage = json_encode($dataArray);

        $mappedArticleDTO = new ArticleDTO();
        $mappedArticleDTO->map($jsonWithoutOpenGraphImage);

        $this->assertNotNull($mappedArticleDTO->getSEO(), "SEO object should be populated");
        $mappedOpenGraph = $mappedArticleDTO->getSEO()->getOpenGraph();
        $this->assertNotNull($mappedOpenGraph, "OpenGraph object should be populated");
        $this->assertEquals('Test OpenGraph Title', $mappedOpenGraph->getTitle());
        $this->assertEquals('Test OpenGraph Description', $mappedOpenGraph->getDescription());
        $this->assertNull($mappedOpenGraph->getImage(), "OpenGraph image should be null when missing from JSON");
    }

    public function testSEOMappingMissingOpenGraphProperties()
    {
        $articleDTO = new ArticleDTO();
        // Set mandatory fields
        $articleDTO->setClientRef('OG_PROPS_MISSING_CLIENT_REF');
        $articleDTO->setTitle('OG Props Missing Test Article');
        // ... (fill in other mandatory fields)
        $articleDTO->setSiteName('OG Props Missing Test Site');
        $articleDTO->setUrl('https://www.example.com/og-props-missing-test');
        $articleDTO->setSlug('og-props-missing-test-slug');
        $articleDTO->setDescription('OG props missing test description');
        $articleDTO->setPublishedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setUpdatedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setLocale('en-GB');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Test DRM'));
        $articleDTO->setAuthor(new Author(name: 'Test Author', email: 'test@example.com', url: 'https://example.com/author', image: 'https://example.com/author.jpg'));
        $articleDTO->setCategories(new Category(name: 'Test Category', slug: 'test-category', notes: 'Test category notes'));
        $articleDTO->setHeroImage(new Image(url: 'https://example.com/hero.jpg', alt: 'Hero', title: 'Hero Title', width: 100, height: 100, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));
        $articleDTO->setThumbnailImage(new Image(url: 'https://example.com/thumb.jpg', alt: 'Thumb', title: 'Thumb Title', width: 50, height: 50, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));

        $openGraphImage = new Image(url: 'https://www.example.com/og-image.jpg', alt: 'OpenGraph Image Alt', title: 'OpenGraph Image Title', width: 1200, height: 630, drm: new DRM(status: DRM::GREEN, notes: 'OG Image DRM'));
        // Intentionally create OpenGraph with a null title to test mapping
        $openGraph = new OpenGraph(
            title: null, // Test case for missing title
            description: 'Test OpenGraph Description',
            image: $openGraphImage
        );
        $seo = new SEO(
            metaTitle: 'Test Meta Title',
            metaDescription: 'Test Meta Description',
            openGraph: $openGraph
        );
        $articleDTO->setSEO($seo);

        $jsonData = $articleDTO->toJson();
        // Simulate title missing in JSON for OpenGraph
        $dataArray = json_decode($jsonData, true);
        unset($dataArray['seo']['openGraph']['title']);
        // Also test with description missing
        // unset($dataArray['seo']['openGraph']['description']);
        $jsonWithMissingOGTitle = json_encode($dataArray);


        $mappedArticleDTO = new ArticleDTO();
        $mappedArticleDTO->map($jsonWithMissingOGTitle);

        $this->assertNotNull($mappedArticleDTO->getSEO(), "SEO object should be populated");
        $mappedOpenGraph = $mappedArticleDTO->getSEO()->getOpenGraph();
        $this->assertNotNull($mappedOpenGraph, "OpenGraph object should be populated");
        $this->assertEquals('', $mappedOpenGraph->getTitle(), "OpenGraph title should be empty string if missing in JSON");
        $this->assertEquals('Test OpenGraph Description', $mappedOpenGraph->getDescription()); // Assuming description is still there
        $this->assertNotNull($mappedOpenGraph->getImage(), "OpenGraph image should be populated");
        $this->assertEquals('https://www.example.com/og-image.jpg', $mappedOpenGraph->getImage()->url);
        // Note: The mapping logic in BaseDTO hardcodes OpenGraph Image DRM to RED
        $this->assertEquals(DRM::RED, $mappedOpenGraph->getImage()->getDrm()->getStatus());
    }

    public function testSEOMappingMissingSEOProperties()
    {
        $articleDTO = new ArticleDTO();
        // Set mandatory fields
        $articleDTO->setClientRef('SEO_PROPS_MISSING_CLIENT_REF');
        $articleDTO->setTitle('SEO Props Missing Test Article');
        // ... (fill in other mandatory fields)
        $articleDTO->setSiteName('SEO Props Missing Test Site');
        $articleDTO->setUrl('https://www.example.com/seo-props-missing-test');
        $articleDTO->setSlug('seo-props-missing-test-slug');
        $articleDTO->setDescription('SEO props missing test description');
        $articleDTO->setPublishedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setUpdatedDate('2023-01-01T00:00:00+00:00');
        $articleDTO->setLocale('en-GB');
        $articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Test DRM'));
        $articleDTO->setAuthor(new Author(name: 'Test Author', email: 'test@example.com', url: 'https://example.com/author', image: 'https://example.com/author.jpg'));
        $articleDTO->setCategories(new Category(name: 'Test Category', slug: 'test-category', notes: 'Test category notes'));
        $articleDTO->setHeroImage(new Image(url: 'https://example.com/hero.jpg', alt: 'Hero', title: 'Hero Title', width: 100, height: 100, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));
        $articleDTO->setThumbnailImage(new Image(url: 'https://example.com/thumb.jpg', alt: 'Thumb', title: 'Thumb Title', width: 50, height: 50, drm: new DRM(status: DRM::GREEN, notes: 'Test DRM')));


        $openGraphImage = new Image(url: 'https://www.example.com/og-image.jpg', alt: 'OpenGraph Image Alt', title: 'OpenGraph Image Title', width: 1200, height: 630, drm: new DRM(status: DRM::GREEN, notes: 'OG Image DRM'));
        $openGraph = new OpenGraph(
            title: 'Test OpenGraph Title',
            description: 'Test OpenGraph Description',
            image: $openGraphImage
        );
        // Intentionally create SEO with a null metaTitle
        $seo = new SEO(
            metaTitle: null, // Test case for missing metaTitle
            metaDescription: 'Test Meta Description',
            openGraph: $openGraph
        );
        $articleDTO->setSEO($seo);

        $jsonData = $articleDTO->toJson();
        // Simulate metaTitle missing in JSON for SEO
        $dataArray = json_decode($jsonData, true);
        unset($dataArray['seo']['metaTitle']);
        // Also test with metaDescription missing
        // unset($dataArray['seo']['metaDescription']);
        $jsonWithMissingSEOTitle = json_encode($dataArray);

        $mappedArticleDTO = new ArticleDTO();
        $mappedArticleDTO->map($jsonWithMissingSEOTitle);

        $this->assertNotNull($mappedArticleDTO->getSEO(), "SEO object should be populated");
        $this->assertEquals('', $mappedArticleDTO->getSEO()->getMetaTitle(), "SEO metaTitle should be empty string if missing in JSON");
        $this->assertEquals('Test Meta Description', $mappedArticleDTO->getSEO()->getMetaDescription()); // Assuming metaDescription is still there

        $mappedOpenGraph = $mappedArticleDTO->getSEO()->getOpenGraph();
        $this->assertNotNull($mappedOpenGraph, "OpenGraph object should be populated");
        $this->assertEquals('Test OpenGraph Title', $mappedOpenGraph->getTitle());
        // Note: The mapping logic in BaseDTO hardcodes OpenGraph Image DRM to RED
        $this->assertEquals(DRM::RED, $mappedOpenGraph->getImage()->getDrm()->getStatus());
    }

}
