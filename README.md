# Content Sharing DTO
DTO is a simple object that represents a complex object in a way that can be easily passed around between different applications. 

These DTOs have been designed specifically for use with the Content Sharing API.

## RecipeDTO example

```php
$recipeDTO = new RecipeDTO();

$recipeDTO->setAuthor(new Author('Adam Lambourne', 'adam.lambourne@immediate.co.uk', 'https://www.example.com', 'https://www.example.com/image.jpg'));
$recipeDTO->setClientRef('ABC123');
$recipeDTO->setDrm(new DRM(3,'Can be used Worldwide'));
$recipeDTO->setSlug('example-recipe-slug');
$recipeDTO->setSiteName('BBCGoodFood');
$recipeDTO->setPublishedDate('2023-02-08T15:00:39+00:00');
$recipeDTO->setUpdatedDate('2023-02-08T17:00:39+00:00');
$recipeDTO->setTitle('Example Recipe');
$recipeDTO->setDescription('Example Recipe Description');
$recipeDTO->setUrl('https://www.example.com/recipe');
$recipeDTO->setHeroImage(new Image('https://www.example.com/image.jpg', 'Hero Image', 'Image title'));
$recipeDTO->setThumbnailImage(new Image('https://www.example.com/image.jpg', 'Thumb Image', 'Image title'));

$recipeDTO->setIngredients(new Ingredient('first Ingredient', '1.5', 'kg', 'my-ingredient', 'My Notes'));
$recipeDTO->setIngredients(new Ingredient('second Ingredient', '2', 'kg', 'my-ingredient', 'My Notes'));

$recipeDTO->setMethodSteps(new MethodStep(1, 'first step'));
$recipeDTO->setMethodSteps(new MethodStep(2, 'second step'));

$recipeDTO->setNutrition(new Nutrition('Calories', '100', 'g',false, false));
$recipeDTO->setNutrition(new Nutrition('Salt', '100', 'g',false, false));

$recipeDTO->setTags(new Tag('recipe tag 1', 'recipe-tag-1', 'tag notes'));
$recipeDTO->setTags(new Tag('recipe tag 2', 'recipe-tag-2', 'tag notes'));

$recipeDTO->setCategories(new Category('Recipes', 'recipes', 'category notes'));
$recipeDTO->setCategories(new Category('Food', 'food', 'category notes'));


$recipeDTO->toJSON();
```


## Example JSON Output
<details>
  <summary>Recipe DTO JSON Output</summary>

```json
{
  "DTO_VERSION": "1.0.0",
  "type": "recipe",
  "clientRef": "ABC123",
  "title": "Example Recipe",
  "siteName": "BBCGoodFood",
  "url": "https:\/\/www.example.com\/recipe",
  "slug": "example-recipe-slug",
  "description": "Example Recipe Description",
  "publishedDate": "2023-02-08T15:00:39+00:00",
  "updatedDate": "2023-02-08T17:00:39+00:00",
  "drm": {
    "status": 3,
    "notes": "Can be used Worldwide"
  },
  "author": {
    "name": "Adam Lambourne",
    "email": "adam.lambourne@immediate.co.uk",
    "url": "https:\/\/www.example.com",
    "image": "https:\/\/www.example.com\/image.jpg"
  },
  "heroImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Hero Image",
    "title": "Image title"
  },
  "thumbnailImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Thumb Image",
    "title": "Image title"
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
      "unit": "g",
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
  ]
}
```
</details>

