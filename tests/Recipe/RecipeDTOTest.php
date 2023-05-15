<?php

namespace ImmediateMedia\ContentSharingDto\Tests;

use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\Tag;
use ImmediateMedia\ContentSharingDto\Recipe\Ingredient;
use ImmediateMedia\ContentSharingDto\Recipe\MethodStep;
use ImmediateMedia\ContentSharingDto\Recipe\Nutrition;
use ImmediateMedia\ContentSharingDto\Recipe\RecipeDTO;
use ImmediateMedia\ContentSharingDto\Recipe\Skill;
use ImmediateMedia\ContentSharingDto\Recipe\Timing;
use PHPUnit\Framework\TestCase;


class RecipeDTOTest extends TestCase
{

    public function testCoreMetaData()
    {

        $recipeDTO = new RecipeDTO();
        $recipeDTO->setAuthor(new Author(name: 'Firstname Lastname', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
        $recipeDTO->setClientRef('ABC123');
        $recipeDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Can be used Worldwide'));
        $recipeDTO->setLocale('en');
        $recipeDTO->setSlug('example-recipe-slug');
        $recipeDTO->setSiteName('Food Website');
        $recipeDTO->setPublishedDate('2023-02-08T15:00:39+00:00');
        $recipeDTO->setUpdatedDate('2023-02-08T17:00:39+00:00');
        $recipeDTO->setTitle('Example Recipe');
        $recipeDTO->setDescription('Example Recipe Description');
        $recipeDTO->setUrl('https://www.example.com/recipe');

        $recipeDTO->setHeroImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Hero Image',
            title: 'Image title',
            width: 800, height: 600,
            drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency'),
            isUpscaled: true,
            srcImage: 'https://www.example.com/src-image.jpg'
        ));

        $recipeDTO->setThumbnailImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Thumb Image',
            title: 'Image title',
            width: 80, height: 60,
            drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency')));


        $recipeDTO->setTags(new Tag(name: 'first tag', slug: 'first-tag',notes: 'first tag notes'));
        $recipeDTO->setTags(new Tag(name: 'second tag', slug: 'second-tag', notes: 'second tag notes'));
        $recipeDTO->setCategories(new Category(name: 'Recipes', slug: 'recipes-slug', notes: 'category notes'));
        $recipeDTO->setCategories(new Category(name: 'Food', slug: 'food-slug', notes: 'category notes'));


        $this->assertEquals('ABC123', $recipeDTO->getClientRef());
        $this->assertEquals('en', $recipeDTO->getLocale());
        $this->assertEquals('example-recipe-slug', $recipeDTO->getSlug());

        $this->assertEquals('Firstname Lastname', $recipeDTO->getAuthor()->getName());
        $this->assertEquals('example@email.com', $recipeDTO->getAuthor()->getEmail());

        $this->assertEquals('Food Website', $recipeDTO->getSiteName());
        $this->assertEquals('2023-02-08T15:00:39+00:00', $recipeDTO->getPublishedDate());
        $this->assertEquals('2023-02-08T17:00:39+00:00', $recipeDTO->getUpdatedDate());
        $this->assertEquals('Example Recipe', $recipeDTO->getTitle());
        $this->assertEquals('Example Recipe Description', $recipeDTO->getDescription());
        $this->assertEquals('https://www.example.com/recipe', $recipeDTO->getUrl());

        $this->assertEquals('https://www.example.com/image.jpg', $recipeDTO->getHeroImage()->getUrl());
        $this->assertEquals('https://www.example.com/image.jpg', $recipeDTO->getThumbnailImage()->getUrl());

        $this->assertEquals(true, $recipeDTO->getHeroImage()->isUpscaled());
        $this->assertEquals(false, $recipeDTO->getThumbnailImage()->isUpscaled());

        $this->assertEquals('https://www.example.com/src-image.jpg', $recipeDTO->getHeroImage()->getSrcImage());


        $this->assertEquals(800, $recipeDTO->getHeroImage()->getWidth());
        $this->assertEquals(600, $recipeDTO->getHeroImage()->getHeight());

        $this->assertEquals(80, $recipeDTO->getThumbnailImage()->getWidth());
        $this->assertEquals(60, $recipeDTO->getThumbnailImage()->getHeight());

        $this->assertEquals(DRM::GREEN, $recipeDTO->getHeroImage()->getDrm()->getStatus());
        $this->assertEquals('Free to use worldwide', $recipeDTO->getHeroImage()->getDrm()->getNotes());

        $this->assertEquals(DRM::YELLOW, $recipeDTO->getThumbnailImage()->getDrm()->getStatus());
        $this->assertEquals('Restricted to UK only', $recipeDTO->getThumbnailImage()->getDrm()->getNotes());

        $this->assertEquals('Copyright Holder', $recipeDTO->getHeroImage()->getDrm()->getCreator());
        $this->assertEquals('Copyright Agency', $recipeDTO->getHeroImage()->getDrm()->getAgency());

        $this->assertEquals('first tag', $recipeDTO->getTags()[0]->getName());
        $this->assertEquals('first-tag', $recipeDTO->getTags()[0]->getSlug());
        $this->assertEquals('first tag notes', $recipeDTO->getTags()[0]->getNotes());

        $this->assertEquals('second tag', $recipeDTO->getTags()[1]->getName());
        $this->assertEquals('second-tag', $recipeDTO->getTags()[1]->getSlug());
        $this->assertEquals('second tag notes', $recipeDTO->getTags()[1]->getNotes());

        $this->assertEquals('Recipes', $recipeDTO->getCategories()[0]->getName());
        $this->assertEquals('recipes-slug', $recipeDTO->getCategories()[0]->getSlug());
        $this->assertEquals('category notes', $recipeDTO->getCategories()[0]->getNotes());

    }

    public function testIngredients()
    {

        $recipeDTO = new RecipeDTO();

        $recipeDTO->setIngredients(new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));
        $recipeDTO->setIngredients(new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));

        $this->assertEquals('first Ingredient', $recipeDTO->getIngredients()[0]->getName());
        $this->assertEquals('1.5', $recipeDTO->getIngredients()[0]->getQuantity());
        $this->assertEquals('kg', $recipeDTO->getIngredients()[0]->getUnit());
        $this->assertEquals('my-ingredient', $recipeDTO->getIngredients()[0]->getSlug());
        $this->assertEquals('My Notes', $recipeDTO->getIngredients()[0]->getNotes());

        $this->assertEquals('second Ingredient', $recipeDTO->getIngredients()[1]->getName());
        $this->assertEquals('2', $recipeDTO->getIngredients()[1]->getQuantity());
        $this->assertEquals('kg', $recipeDTO->getIngredients()[1]->getUnit());
        $this->assertEquals('my-ingredient', $recipeDTO->getIngredients()[1]->getSlug());
        $this->assertEquals('My Notes', $recipeDTO->getIngredients()[1]->getNotes());
    }

    public function testMethodSteps()
    {

        $recipeDTO = new RecipeDTO();

        $recipeDTO->setMethodSteps(new MethodStep(stepNumber: 1, description: 'first step'));
        $recipeDTO->setMethodSteps(new MethodStep(stepNumber: 2, description: 'second step'));

        // Assert that the recipeDTO has the correct method steps
        $this->assertEquals(1, $recipeDTO->getMethodSteps()[0]->getStepNumber());
        $this->assertEquals('first step', $recipeDTO->getMethodSteps()[0]->getDescription());

        $this->assertEquals(2, $recipeDTO->getMethodSteps()[1]->getStepNumber());
        $this->assertEquals('second step', $recipeDTO->getMethodSteps()[1]->getDescription());
    }

    public function testNutrition()
    {

        $recipeDTO = new RecipeDTO();

        $recipeDTO->setNutrition(new Nutrition(label: 'Calories', value: '100', unit: 'g', high: false, low: false));
        $recipeDTO->setNutrition(new Nutrition(label: 'Salt', value: '100', unit: 'g', high: false, low: false));

        $this->assertEquals('Calories', $recipeDTO->getNutrition()[0]->getLabel());
        $this->assertEquals('100', $recipeDTO->getNutrition()[0]->getValue());
        $this->assertEquals('g', $recipeDTO->getNutrition()[0]->getUnit());
        $this->assertEquals(false, $recipeDTO->getNutrition()[0]->getHigh());
        $this->assertEquals(false, $recipeDTO->getNutrition()[0]->getLow());

        $this->assertEquals('Salt', $recipeDTO->getNutrition()[1]->getLabel());
        $this->assertEquals('100', $recipeDTO->getNutrition()[1]->getValue());
        $this->assertEquals('g', $recipeDTO->getNutrition()[1]->getUnit());
        $this->assertEquals(false, $recipeDTO->getNutrition()[1]->getHigh());
        $this->assertEquals(false, $recipeDTO->getNutrition()[1]->getLow());
    }

    public function testSkillLevels()
    {
        $recipeDTO = new RecipeDTO();

        $recipeDTO->setSkillLevel(SKILL::EASY);
        $this->assertEquals(SKILL::EASY, $recipeDTO->getSkillLevel());
    }

    public function testTimings()
    {
        $recipeDTO = new RecipeDTO();

        $recipeDTO->setTiming(new Timing(cookingMax: 20, maxCookingTime: 20, cookingMin: 10,
            minCookingTime: 10, preparationMax: 5, maxPreparationTime: 5, preparationMin: 3,
            minPreparationTime: 3, note: 'timing notes', total: 45, totalTime: 45));

        $this->assertEquals(20, $recipeDTO->getTiming()->getCookingMax());
        $this->assertEquals(20, $recipeDTO->getTiming()->getMaxCookingTime());
        $this->assertEquals(10, $recipeDTO->getTiming()->getCookingMin());
        $this->assertEquals(10, $recipeDTO->getTiming()->getMinCookingTime());
        $this->assertEquals(5, $recipeDTO->getTiming()->getPreparationMax());
        $this->assertEquals(5, $recipeDTO->getTiming()->getMaxPreparationTime());
        $this->assertEquals(3, $recipeDTO->getTiming()->getPreparationMin());
        $this->assertEquals(3, $recipeDTO->getTiming()->getMinPreparationTime());
        $this->assertEquals(45, $recipeDTO->getTiming()->getTotal());
        $this->assertEquals(45, $recipeDTO->getTiming()->getTotalTime());
        $this->assertEquals('timing notes', $recipeDTO->getTiming()->getNote());

    }

    public function testCuisine()
    {
        $recipeDTO = new RecipeDTO();
        $recipeDTO->setCuisine('British');
        $recipeDTO->setCuisine('Indian');

        $this->assertEquals('British', $recipeDTO->getCuisines()[0]);
        $this->assertEquals('Indian', $recipeDTO->getCuisines()[1]);
    }

    public function testMapper()
    {
        $jsonData = '{"BASE_DTO_VERSION":"1.0.3","type":"recipe","clientRef":"ABC123","title":"Example Recipe","siteName":"Best Food Site","url":"https:\/\/www.example.com\/recipe","slug":"example-recipe-slug","description":"Example Recipe Description","publishedDate":"2023-02-08T15:00:39+00:00","updatedDate":"2023-02-08T17:00:39+00:00","locale":"en","drm":{"status":1,"notes":"Recipe can be used Worldwide","creator":"unknown","agency":"unknown"},"author":{"name":"Firstname Lastname","email":"example@email.com","url":"https:\/\/www.example.com","image":"https:\/\/www.example.com\/image.jpg"},"heroImage":{"url":"https:\/\/www.example.com\/image.jpg","alt":"Hero Image","title":"Image title","width":800,"height":600,"drm":{"status":1,"notes":"Free to use worldwide","creator":"Copyright Holder","agency":"Copyright Agency"},"isUpscaled":false,"srcImage":""},"thumbnailImage":{"url":"https:\/\/www.example.com\/image.jpg","alt":"Thumb Image","title":"Image title","width":80,"height":60,"drm":{"status":2,"notes":"Restricted to UK only","creator":"Copyright Holder","agency":"Copyright Agency"},"isUpscaled":false,"srcImage":""},"tags":[{"name":"recipe tag 1","slug":"recipe-tag-1","notes":"tag notes"},{"name":"recipe tag 2","slug":"recipe-tag-2","notes":"tag notes"}],"categories":[{"name":"Recipes","slug":"recipes","notes":"category notes"},{"name":"Food","slug":"food","notes":"category notes"}],"RECIPE_DTO_VERSION":"1.0.4","ingredients":[{"name":"first Ingredient","quantity":"1.5","unit":"kg","slug":"my-ingredient","notes":"My Notes"},{"name":"second Ingredient","quantity":"2","unit":"kg","slug":"my-ingredient","notes":"My Notes"}],"methodSteps":[{"stepNumber":1,"description":"first step"},{"stepNumber":2,"description":"second step"}],"nutrition":[{"label":"Calories","value":"100","unit":"kcal","high":false,"low":false},{"label":"Salt","value":"100","unit":"g","high":false,"low":false}],"timing":{"cookingMax":20,"maxCookingTime":20,"cookingMin":10,"minCookingTime":10,"preparationMax":5,"maxPreparationTime":5,"preparationMin":3,"minPreparationTime":3,"note":"","total":45,"totalTime":45},"skillLevel":"easy","servings":4,"cuisines":["British","Indian"]}';
        $recipeDTO = new RecipeDTO();
        $recipeDTO->map($jsonData);
        $this->assertEquals($jsonData, $recipeDTO->toJson());
    }



}
