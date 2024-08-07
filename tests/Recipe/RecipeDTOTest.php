<?php

namespace ImmediateMedia\ContentSharingDto\Tests;

use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Generic\Tag;
use ImmediateMedia\ContentSharingDto\Recipe\Cuisine;
use ImmediateMedia\ContentSharingDto\Recipe\Diet;
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
        $recipeDTO->setVersion(2);
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
            drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '123'),
            isUpscaled: true,
            srcImage: 'https://www.example.com/src-image.jpg',
            exif: ['camera' => 'Canon EOS 5D Mark IV', 'lens' => 'EF24-70mm f/2.8L II USM'],
            labels: ['cake', 'dessert'],
            objects: ['knife', 'fork'],
            assetId: 'asset-123',
            isPlaceholder: false
        ));

        $recipeDTO->setThumbnailImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Thumb Image',
            title: 'Image title',
            width: 80, height: 60,
            drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '124')));


        $recipeDTO->setTags(new Tag(name: 'first tag', slug: 'first-tag',notes: 'first tag notes'));
        $recipeDTO->setTags(new Tag(name: 'second tag', slug: 'second-tag', notes: 'second tag notes'));
        $recipeDTO->setCategories(new Category(name: 'Recipes', slug: 'recipes-slug', notes: 'category notes'));
        $recipeDTO->setCategories(new Category(name: 'Food', slug: 'food-slug', notes: 'category notes'));

        $recipeDTO->setIntroduction('Introduction text');
        $recipeDTO->setSummary('Summary text');


        $this->assertEquals('ABC123', $recipeDTO->getClientRef());
        $this->assertEquals(2, $recipeDTO->getVersion());
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

        $this->assertEquals(['cake', 'dessert'], $recipeDTO->getHeroImage()->getLabels());
        $this->assertEquals(['knife', 'fork'], $recipeDTO->getHeroImage()->getObjects());
        $this->assertEquals('asset-123', $recipeDTO->getHeroImage()->getAssetId());
        $this->assertEquals(false, $recipeDTO->getHeroImage()->isPlaceholder());
        $this->assertEquals(['camera' => 'Canon EOS 5D Mark IV', 'lens' => 'EF24-70mm f/2.8L II USM'], $recipeDTO->getHeroImage()->getExif());
        $this->assertEquals(DRM::YELLOW, $recipeDTO->getThumbnailImage()->getDrm()->getStatus());
        $this->assertEquals('Restricted to UK only', $recipeDTO->getThumbnailImage()->getDrm()->getNotes());

        $this->assertEquals('Copyright Holder', $recipeDTO->getHeroImage()->getDrm()->getCreator());
        $this->assertEquals('Copyright Agency', $recipeDTO->getHeroImage()->getDrm()->getAgency());

        $this->assertEquals('123', $recipeDTO->getHeroImage()->getDrm()->getDamId());
        $this->assertEquals('124', $recipeDTO->getThumbnailImage()->getDrm()->getDamId());

        $this->assertEquals('first tag', $recipeDTO->getTags()[0]->getName());
        $this->assertEquals('first-tag', $recipeDTO->getTags()[0]->getSlug());
        $this->assertEquals('first tag notes', $recipeDTO->getTags()[0]->getNotes());

        $this->assertEquals('second tag', $recipeDTO->getTags()[1]->getName());
        $this->assertEquals('second-tag', $recipeDTO->getTags()[1]->getSlug());
        $this->assertEquals('second tag notes', $recipeDTO->getTags()[1]->getNotes());

        $this->assertEquals('Recipes', $recipeDTO->getCategories()[0]->getName());
        $this->assertEquals('recipes-slug', $recipeDTO->getCategories()[0]->getSlug());
        $this->assertEquals('category notes', $recipeDTO->getCategories()[0]->getNotes());

        $this->assertEquals('Introduction text', $recipeDTO->getIntroduction());
        $this->assertEquals('Summary text', $recipeDTO->getSummary());

    }

    public function testIngredients()
    {

        $recipeDTO = new RecipeDTO();

        $recipeDTO->setIngredients(new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes', group: 'first group' ));
        $recipeDTO->setIngredients(new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes', group: 'second group'));

        $recipeDTO->setIngredientsGroups(['first group', 'second group']);

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

        $this->assertEquals('first group', $recipeDTO->getIngredients()[0]->getGroup());
        $this->assertEquals('second group', $recipeDTO->getIngredients()[1]->getGroup());

        $this->assertEquals('first group', $recipeDTO->getIngredientsGroups()[0]);
        $this->assertEquals('second group', $recipeDTO->getIngredientsGroups()[1]);
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
        $recipeDTO->setCuisine(new Cuisine('British', 'british-cuisine'));
        $recipeDTO->setCuisine(new Cuisine('Indian', 'indian-cuisine'));

        $this->assertEquals('British', $recipeDTO->getCuisines()[0]->getName());
        $this->assertEquals('Indian', $recipeDTO->getCuisines()[1]->getName());

        $this->assertEquals('british-cuisine', $recipeDTO->getCuisines()[0]->getSlug());
        $this->assertEquals('indian-cuisine', $recipeDTO->getCuisines()[1]->getSlug());
    }

    public function testDiet()
    {
        $recipeDTO = new RecipeDTO();
        $recipeDTO->setDiet(new Diet('Vegetarian', 'vegetarian-diet'));
        $recipeDTO->setDiet(new Diet('Vegan', 'vegan-diet'));

        $this->assertEquals('Vegetarian', $recipeDTO->getDiets()[0]->getName());
        $this->assertEquals('Vegan', $recipeDTO->getDiets()[1]->getName());

        $this->assertEquals('vegetarian-diet', $recipeDTO->getDiets()[0]->getSlug());
        $this->assertEquals('vegan-diet', $recipeDTO->getDiets()[1]->getSlug());
    }


    public function testImageMeta()
    {
        $recipeDTO = new RecipeDTO();
        $recipeDTO->setHeroImage(new Image(
            url: 'https://www.example.com/image.jpg',
            alt: 'Hero Image',
            title: 'Image title',
            width: 800, height: 600,
            drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '123'),
            isUpscaled: true,
            srcImage: 'https://www.example.com/src-image.jpg'
        ));

        $recipeDTO->getHeroImage()->setExif(['camera'=>'Canon EOS 5D Mark IV', 'lens'=>'EF24-70mm f/2.8L II USM']);
        $recipeDTO->getHeroImage()->setLabels(['cake', 'dessert']);
        $recipeDTO->getHeroImage()->setObjects(['knife', 'fork']);


        $this->assertEquals('cake', $recipeDTO->getHeroImage()->getLabels()[0]);
        $this->assertEquals('dessert', $recipeDTO->getHeroImage()->getLabels()[1]);
        $this->assertEquals('knife', $recipeDTO->getHeroImage()->getObjects()[0]);
        $this->assertEquals('fork', $recipeDTO->getHeroImage()->getObjects()[1]);
        $this->assertEquals('Canon EOS 5D Mark IV', $recipeDTO->getHeroImage()->getExif()['camera']);
        $this->assertEquals('EF24-70mm f/2.8L II USM', $recipeDTO->getHeroImage()->getExif()['lens']);

    }


    public function testMapper()
    {
        $recipeDTO1 = new RecipeDTO();
        $recipeDTO1->setVersion(2);
        $recipeDTO1->setTrackingId('CS-2d5bf4a54bd6a70411bbe0fd0eea85fc');
        $recipeDTO1->setClientRef('ABC123');
        $recipeDTO1->setTitle('Example Recipe');
        $recipeDTO1->setSiteName('Best Food Site');
        $recipeDTO1->setUrl('https://www.example.com/recipe');
        $recipeDTO1->setSlug('example-recipe-slug');
        $recipeDTO1->setDescription('Example Recipe Description');
        $recipeDTO1->setPublishedDate('2023-02-08T15:00:39+00:00');
        $recipeDTO1->setUpdatedDate('2023-02-08T17:00:39+00:00');
        $recipeDTO1->setLocale('en');
        $recipeDTO1->setDrm(new DRM(status: DRM::GREEN, notes: 'Recipe can be used Worldwide', creator: 'unknown', agency: 'unknown', damId: ''));
        $recipeDTO1->setAuthor(new Author(name: 'Firstname Lastname', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
        $recipeDTO1->setHeroImage(new Image(
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
            assetId: 'CS-12343973947',
            isPlaceholder: false
        ));
        $recipeDTO1->setThumbnailImage(new Image(
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
        $recipeDTO1->setTags(new Tag(name: 'recipe tag 1', slug: 'recipe-tag-1', notes: 'tag notes'));
        $recipeDTO1->setTags(new Tag(name: 'recipe tag 2', slug: 'recipe-tag-2', notes: 'tag notes'));
        $recipeDTO1->setCategories(new Category(name: 'Recipes', slug: 'recipes-slug', notes: 'category notes'));
        $recipeDTO1->setCategories(new Category(name: 'Food', slug: 'food-slug', notes: 'category notes'));
        $recipeDTO1->setVersion(2);
        $recipeDTO1->setIngredients(new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes', group: 'sauce'));
        $recipeDTO1->setIngredients(new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes', group: 'pasta'));
        $recipeDTO1->setMethodSteps(new MethodStep(stepNumber: 1, description: 'first step'));
        $recipeDTO1->setMethodSteps(new MethodStep(stepNumber: 2, description: 'second step'));
        $recipeDTO1->setNutrition(new Nutrition(label: 'Calories', value: '100', unit: 'kcal', high: false, low: false));
        $recipeDTO1->setNutrition(new Nutrition(label: 'Salt', value: '100', unit: 'g', high: false, low: false));
        $recipeDTO1->setTiming(new Timing(cookingMax: 20, maxCookingTime: 20, cookingMin: 10, minCookingTime: 10, preparationMax: 5, maxPreparationTime: 5, preparationMin: 3, minPreparationTime: 3, note: '', total: 45, totalTime: 45));
        $recipeDTO1->setSkillLevel('easy');
        $recipeDTO1->setServings(4);
        $recipeDTO1->setCuisine(new Cuisine(name: 'British', slug: 'british-cuisine'));
        $recipeDTO1->setCuisine(new Cuisine(name: 'Indian', slug: 'indian-cuisine'));
        $recipeDTO1->setDiet(new Diet(name: 'Vegetarian', slug: 'vegetarian-diet'));
        $recipeDTO1->setDiet(new Diet(name: 'Vegan', slug: 'vegan-diet'));
        $recipeDTO1->setIngredientsGroups(['sauce', 'pasta']);
        $recipeDTO1->setIntroduction('Introduction text');
        $recipeDTO1->setSummary('Summary text');
        $recipeDTO1->setServingsDisplayText('Serves 4');

        $jsonData = $recipeDTO1->toJson();

        $recipeDTO2 = new RecipeDTO();
        $recipeDTO2->map($jsonData);

        $this->assertEquals($recipeDTO1, $recipeDTO2);
    }


    public function testValidator()
    {
        
        $recipeDTO1 = new RecipeDTO();
        $recipeDTO1->setVersion(2);
        $recipeDTO1->setTrackingId('CS-2d5bf4a54bd6a70411bbe0fd0eea85fc');
        $recipeDTO1->setClientRef('ABC123');
        $recipeDTO1->setTitle('Example Recipe');
        $recipeDTO1->setSiteName('Best Food Site');
        $recipeDTO1->setUrl('https://www.example.com/recipe');
        $recipeDTO1->setSlug('example-recipe-slug');
        $recipeDTO1->setDescription('Example Recipe Description');
        $recipeDTO1->setPublishedDate('2023-02-08T15:00:39+00:00');
        $recipeDTO1->setUpdatedDate('2023-02-08T17:00:39+00:00');
        $recipeDTO1->setLocale('en');
        $recipeDTO1->setDrm(new DRM(status: DRM::GREEN, notes: 'Recipe can be used Worldwide', creator: 'unknown', agency: 'unknown', damId: ''));
        $recipeDTO1->setAuthor(new Author(name: 'Firstname Lastname', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
        $recipeDTO1->setHeroImage(new Image(
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
            assetId: 'CS-12343973947',
            isPlaceholder: false
        ));
        $recipeDTO1->setThumbnailImage(new Image(
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
        $recipeDTO1->setTags(new Tag(name: 'recipe tag 1', slug: 'recipe-tag-1', notes: 'tag notes'));
        $recipeDTO1->setTags(new Tag(name: 'recipe tag 2', slug: 'recipe-tag-2', notes: 'tag notes'));
        $recipeDTO1->setCategories(new Category(name: 'Recipes', slug: 'recipes-slug', notes: 'category notes'));
        $recipeDTO1->setCategories(new Category(name: 'Food', slug: 'food-slug', notes: 'category notes'));
        $recipeDTO1->setVersion(2);
        $recipeDTO1->setIngredients(new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes', group: 'sauce'));
        $recipeDTO1->setIngredients(new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes', group: 'pasta'));
        $recipeDTO1->setMethodSteps(new MethodStep(stepNumber: 1, description: 'first step'));
        $recipeDTO1->setMethodSteps(new MethodStep(stepNumber: 2, description: 'second step'));
        $recipeDTO1->setNutrition(new Nutrition(label: 'Calories', value: '100', unit: 'kcal', high: false, low: false));
        $recipeDTO1->setNutrition(new Nutrition(label: 'Salt', value: '100', unit: 'g', high: false, low: false));
        $recipeDTO1->setTiming(new Timing(cookingMax: 20, maxCookingTime: 20, cookingMin: 10, minCookingTime: 10, preparationMax: 5, maxPreparationTime: 5, preparationMin: 3, minPreparationTime: 3, note: '', total: 45, totalTime: 45));
        $recipeDTO1->setSkillLevel('easy');
        $recipeDTO1->setServings(4);
        $recipeDTO1->setCuisine(new Cuisine(name: 'British', slug: 'british-cuisine'));
        $recipeDTO1->setCuisine(new Cuisine(name: 'Indian', slug: 'indian-cuisine'));
        $recipeDTO1->setDiet(new Diet(name: 'Vegetarian', slug: 'vegetarian-diet'));
        $recipeDTO1->setDiet(new Diet(name: 'Vegan', slug: 'vegan-diet'));
        $recipeDTO1->setIngredientsGroups(['sauce', 'pasta']);
        $recipeDTO1->setIntroduction('Introduction text');
        $recipeDTO1->setSummary('Summary text');
        $recipeDTO1->setServingsDisplayText('Serves 4');

        $this->assertTrue($recipeDTO1->validate());
    }

}
