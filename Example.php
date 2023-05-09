<?php

require 'vendor/autoload.php';


use ImmediateMedia\ContentSharingDto\Article\ArticleDTO;
use ImmediateMedia\ContentSharingDto\Recipe\RecipeDTO;
use ImmediateMedia\ContentSharingDto\Generic\Author;
use ImmediateMedia\ContentSharingDto\Generic\Image;
use ImmediateMedia\ContentSharingDto\Recipe\Ingredient;
use ImmediateMedia\ContentSharingDto\Recipe\MethodStep;
use ImmediateMedia\ContentSharingDto\Recipe\Nutrition;
use ImmediateMedia\ContentSharingDto\Generic\Tag;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\DRM;
use ImmediateMedia\ContentSharingDto\Recipe\Skill;
use ImmediateMedia\ContentSharingDto\Recipe\Timing;


/**
 * =====================================================================================================================
 * Example use of the Recipe DTO
 * =====================================================================================================================
 */
$recipeDTO = new RecipeDTO();

$recipeDTO->setAuthor(new Author(name: 'Firstname Lastname', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
$recipeDTO->setClientRef('ABC123');
$recipeDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Recipe can be used Worldwide'));
$recipeDTO->setLocale('en');
$recipeDTO->setSlug('example-recipe-slug');
$recipeDTO->setSiteName('Best Food Site');
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
    drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency')));

$recipeDTO->setThumbnailImage(new Image(
    url: 'https://www.example.com/image.jpg',
    alt: 'Thumb Image',
    title: 'Image title',
    width: 80, height: 60,
    drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency')));

$recipeDTO->setIngredients(new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));
$recipeDTO->setIngredients(new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));

$recipeDTO->setMethodSteps(new MethodStep(stepNumber: 1, description: 'first step'));
$recipeDTO->setMethodSteps(new MethodStep(stepNumber: 2, description: 'second step'));

$recipeDTO->setNutrition(new Nutrition(label: 'Calories', value: '100', unit: Nutrition::KCALS, high: false, low: false));
$recipeDTO->setNutrition(new Nutrition(label: 'Salt', value: '100', unit: Nutrition::GRAMS, high: false, low: false));

$recipeDTO->setTags(new Tag(name: 'recipe tag 1', slug: 'recipe-tag-1', notes: 'tag notes'));
$recipeDTO->setTags(new Tag(name: 'recipe tag 2', slug: 'recipe-tag-2', notes: 'tag notes'));

$recipeDTO->setCategories(new Category(name: 'Recipes', slug: 'recipes', notes: 'category notes'));
$recipeDTO->setCategories(new Category(name: 'Food', slug: 'food', notes: 'category notes'));

$recipeDTO->setTiming(new Timing(cookingMax: 20, maxCookingTime: 20, cookingMin: 10, minCookingTime: 10, preparationMax: 5, maxPreparationTime: 5, preparationMin: 3, minPreparationTime: 3, note: '', total: 45, totalTime: 45));

$recipeDTO->setSkillLevel(SKILL::EASY);
$recipeDTO->setServings(4);


// Throws exception if the DTO is not valid
$recipeDTO->validate();

// Returns the DTO as a JSON string
echo $recipeDTO->toJSON(JSON_PRETTY_PRINT);


/**
 * =====================================================================================================================
 * Example Map JSON to Recipe DTO
 * =====================================================================================================================
 */

$jsonData = '{"BASE_DTO_VERSION":"1.0.1","type":"recipe","clientRef":"ABC123","title":"Example Recipe","siteName":"Best Food Site","url":"https:\/\/www.example.com\/recipe","slug":"example-recipe-slug","description":"Example Recipe Description","publishedDate":"2023-02-08T15:00:39+00:00","updatedDate":"2023-02-08T17:00:39+00:00","locale":"en","drm":{"status":1,"notes":"Recipe can be used Worldwide","creator":"unknown","agency":"unknown"},"author":{"name":"Firstname Lastname","email":"example@email.com","url":"https:\/\/www.example.com","image":"https:\/\/www.example.com\/image.jpg"},"heroImage":{"url":"https:\/\/www.example.com\/image.jpg","alt":"Hero Image","title":"Image title","width":800,"height":600,"drm":{"status":1,"notes":"Free to use worldwide","creator":"unknown","agency":"unknown"}},"thumbnailImage":{"url":"https:\/\/www.example.com\/image.jpg","alt":"Thumb Image","title":"Image title","width":80,"height":60,"drm":{"status":2,"notes":"Restricted to UK only","creator":"unknown","agency":"unknown"}},"tags":[{"name":"recipe tag 1","slug":"recipe-tag-1","notes":"tag notes"},{"name":"recipe tag 2","slug":"recipe-tag-2","notes":"tag notes"}],"categories":[{"name":"Recipes","slug":"recipes","notes":"category notes"},{"name":"Food","slug":"food","notes":"category notes"}],"RECIPE_DTO_VERSION":"1.0.2","ingredients":[{"name":"first Ingredient","quantity":"1.5","unit":"kg","slug":"my-ingredient","notes":"My Notes"},{"name":"second Ingredient","quantity":"2","unit":"kg","slug":"my-ingredient","notes":"My Notes"}],"methodSteps":[{"stepNumber":1,"description":"first step"},{"stepNumber":2,"description":"second step"}],"nutrition":[{"label":"Calories","value":"100","unit":"kcal","high":false,"low":false},{"label":"Salt","value":"100","unit":"g","high":false,"low":false}],"timing":{"cookingMax":20,"maxCookingTime":20,"cookingMin":10,"minCookingTime":10,"preparationMax":5,"maxPreparationTime":5,"preparationMin":3,"minPreparationTime":3,"note":"","total":45,"totalTime":45},"skillLevel":"easy","servings":4}';
$recipeDTO = new RecipeDTO();
$recipeDTO->map($jsonData);
$recipeDTO->validate();


/**
 * =====================================================================================================================
 * Example use of the Article DTO
 * =====================================================================================================================
 */
$articleDTO = new ArticleDTO();

$articleDTO->setAuthor(new Author(name: 'Adam Lambourne', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
$articleDTO->setClientRef('ABC123');
$articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Article can be used Worldwide'));
$articleDTO->setLocale('en');
$articleDTO->setSlug('example-recipe-slug');
$articleDTO->setSiteName('Good Food');
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
    drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency')));

$articleDTO->setThumbnailImage(new Image(
    url: 'https://www.example.com/image.jpg',
    alt: 'Thumb Image',
    title: 'Image title',
    width: 80, height: 60,
    drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency')));

$articleDTO->setTags(new Tag(name: 'recipe tag 1', slug: 'recipe-tag-1', notes: 'tag notes'));
$articleDTO->setTags(new Tag(name: 'recipe tag 2', slug: 'recipe-tag-2', notes: 'tag notes'));

$articleDTO->setCategories(new Category(name: 'Recipes', slug: 'recipes', notes: 'category notes'));
$articleDTO->setCategories(new Category(name: 'Food', slug: 'food', notes: 'category notes'));

$articleDTO->setContentHtml('<p>Example Article Body with full markup</p>');
$articleDTO->setContentText('Example Article Body with no markup');


// Throws exception if the DTO is not valid
$articleDTO->validate();

// Returns the DTO as a JSON string
echo $articleDTO->toJSON(JSON_PRETTY_PRINT);


