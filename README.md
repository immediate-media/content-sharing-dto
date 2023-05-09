# Content Sharing DTO
DTO is a simple object that represents a complex object in a way that can be easily passed around between different applications. 

These DTOs have been designed specifically for use with the Content Sharing API.

## Installation

```bash
composer config repositories.content-sharing-dto vcs https://www.github.com/immediate-media/content-sharing-dto.git
composer require immediate-media/content-sharing-dto "^1.0.0"
```


## RecipeDTO export example

```php
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
echo $recipeDTO->toJSON();




```
##  Map JSON to DTO example

```php
// To Map received JSON data to DTO
$recipeDTO = new RecipeDTO();
$recipeDTO->map($jsonData);
$recipeDTO->validate();
```


## Example JSON Output
<details>
  <summary>Recipe DTO JSON Output</summary>

```json
{
  "BASE_DTO_VERSION": "1.0.2",
  "type": "recipe",
  "clientRef": "ABC123",
  "title": "Example Recipe",
  "siteName": "Best Food Site",
  "url": "https:\/\/www.example.com\/recipe",
  "slug": "example-recipe-slug",
  "description": "Example Recipe Description",
  "publishedDate": "2023-02-08T15:00:39+00:00",
  "updatedDate": "2023-02-08T17:00:39+00:00",
  "locale": "en",
  "drm": {
    "status": 1,
    "notes": "Recipe can be used Worldwide",
    "creator": "unknown",
    "agency": "unknown"
  },
  "author": {
    "name": "Firstname Lastname",
    "email": "example@email.com",
    "url": "https:\/\/www.example.com",
    "image": "https:\/\/www.example.com\/image.jpg"
  },
  "heroImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Hero Image",
    "title": "Image title",
    "width": 800,
    "height": 600,
    "drm": {
      "status": 1,
      "notes": "Free to use worldwide",
      "creator": "Copyright Holder",
      "agency": "Copyright Agency"
    }
  },
  "thumbnailImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Thumb Image",
    "title": "Image title",
    "width": 80,
    "height": 60,
    "drm": {
      "status": 2,
      "notes": "Restricted to UK only",
      "creator": "Copyright Holder",
      "agency": "Copyright Agency"
    }
  },
  "tags": [
    {
      "name": "recipe tag 1",
      "slug": "recipe-tag-1",
      "notes": "tag notes"
    },
    {
      "name": "recipe tag 2",
      "slug": "recipe-tag-2",
      "notes": "tag notes"
    }
  ],
  "categories": [
    {
      "name": "Recipes",
      "slug": "recipes",
      "notes": "category notes"
    },
    {
      "name": "Food",
      "slug": "food",
      "notes": "category notes"
    }
  ],
  "RECIPE_DTO_VERSION": "1.0.3",
  "ingredients": [
    {
      "name": "first Ingredient",
      "quantity": "1.5",
      "unit": "kg",
      "slug": "my-ingredient",
      "notes": "My Notes"
    },
    {
      "name": "second Ingredient",
      "quantity": "2",
      "unit": "kg",
      "slug": "my-ingredient",
      "notes": "My Notes"
    }
  ],
  "methodSteps": [
    {
      "stepNumber": 1,
      "description": "first step"
    },
    {
      "stepNumber": 2,
      "description": "second step"
    }
  ],
  "nutrition": [
    {
      "label": "Calories",
      "value": "100",
      "unit": "kcal",
      "high": false,
      "low": false
    },
    {
      "label": "Salt",
      "value": "100",
      "unit": "g",
      "high": false,
      "low": false
    }
  ],
  "timing": {
    "cookingMax": 20,
    "maxCookingTime": 20,
    "cookingMin": 10,
    "minCookingTime": 10,
    "preparationMax": 5,
    "maxPreparationTime": 5,
    "preparationMin": 3,
    "minPreparationTime": 3,
    "note": "",
    "total": 45,
    "totalTime": 45
  },
  "skillLevel": "easy",
  "servings": 4
}
```
</details>

