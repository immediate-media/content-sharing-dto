# Content Sharing DTO
DTO is a simple object that represents a complex object in a way that can be easily passed around between different applications.

The key advantage of using DTOs lies in their ability to simplify the interaction between different applications, irrespective of their underlying technologies or platforms.

These DTOs have been designed specifically for use with the Content Sharing API.

## Installation

```bash
composer config repositories.content-sharing-dto vcs https://www.github.com/immediate-media/content-sharing-dto.git
composer require immediate-media/content-sharing-dto "^1.0.0"
```


## DTO usage examples
### Recipe DTO 

---

<details>
  <summary>Recipe DTO </summary>

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
    drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '12345')));

$recipeDTO->setThumbnailImage(new Image(
    url: 'https://www.example.com/image.jpg',
    alt: 'Thumb Image',
    title: 'Image title',
    width: 80, height: 60,
    drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency',  damId: '12346')));

$recipeDTO->setIngredients(new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));
$recipeDTO->setIngredients(new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));

$recipeDTO->setMethodSteps(new MethodStep(stepNumber: 1, description: 'first step'));
$recipeDTO->setMethodSteps(new MethodStep(stepNumber: 2, description: 'second step'));

$recipeDTO->setNutrition(new Nutrition(label: 'Calories', value: '100', unit: Nutrition::KCALS, high: false, low: false));
$recipeDTO->setNutrition(new Nutrition(label: 'Salt', value: '100', unit: Nutrition::GRAMS, high: false, low: false));

$recipeDTO->setTags(new Tag(name: 'recipe tag 1', slug: 'recipe-tag-1', notes: 'tag notes'));
$recipeDTO->setTags(new Tag(name: 'recipe tag 2', slug: 'recipe-tag-2', notes: 'tag notes'));

$recipeDTO->setCategories(new Category(name: 'Recipes', slug: 'recipes-slug', notes: 'category notes'));
$recipeDTO->setCategories(new Category(name: 'Food', slug: 'food-slug', notes: 'category notes'));

$recipeDTO->setTiming(new Timing(cookingMax: 20, maxCookingTime: 20, cookingMin: 10, minCookingTime: 10, preparationMax: 5, maxPreparationTime: 5, preparationMin: 3, minPreparationTime: 3, note: '', total: 45, totalTime: 45));

$recipeDTO->setSkillLevel(SKILL::EASY);
$recipeDTO->setServings(4);

$recipeDTO->setCuisine(new Cuisine(name: 'British', slug: 'british-cuisine'));
$recipeDTO->setCuisine(new Cuisine(name: 'Indian', slug: 'indian-cuisine'));

$recipeDTO->setDiet(new Diet(name: 'Vegetarian', slug: 'vegetarian-diet'));
$recipeDTO->setDiet(new Diet(name: 'Vegan', slug: 'vegan-diet'));

// Throws exception if the DTO is not valid
$recipeDTO->validate();

// Returns the DTO as a JSON string
echo $recipeDTO->toJSON();




```
</details>

<details>
  <summary>Recipe JSON Output</summary>

```json
{
  "BASE_DTO_VERSION": "1.0.4",
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
    "agency": "unknown",
    "damId": ""
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
    "isUpscaled": false,
    "srcImage": "",
    "exif": [],
    "labels": [],
    "objects": [],
    "drm": {
      "status": 1,
      "notes": "Free to use worldwide",
      "creator": "Copyright Holder",
      "agency": "Copyright Agency",
      "damId": "12345"
    }
  },
  "thumbnailImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Thumb Image",
    "title": "Image title",
    "width": 80,
    "height": 60,
    "isUpscaled": false,
    "srcImage": "",
    "exif": [],
    "labels": [],
    "objects": [],
    "drm": {
      "status": 2,
      "notes": "Restricted to UK only",
      "creator": "Copyright Holder",
      "agency": "Copyright Agency",
      "damId": "12346"
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
      "slug": "recipes-slug",
      "notes": "category notes"
    },
    {
      "name": "Food",
      "slug": "food-slug",
      "notes": "category notes"
    }
  ],
  "RECIPE_DTO_VERSION": "1.0.6",
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
  "servings": 4,
  "cuisines": [
    {
      "name": "British",
      "slug": "british-cuisine"
    },
    {
      "name": "Indian",
      "slug": "indian-cuisine"
    }
  ],
  "diets": [
    {
      "name": "Vegetarian",
      "slug": "vegetarian-diet"
    },
    {
      "name": "Vegan",
      "slug": "vegan-diet"
    }
  ]
}
```
</details>

---


### Article DTO

---

<details>
  <summary>Article DTO </summary>

```php
$articleDTO = new ArticleDTO();

$articleDTO->setAuthor(new Author(name: 'Adam Lambourne', email: 'example@email.com', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
$articleDTO->setClientRef('ABC123');
$articleDTO->setDrm(new DRM(status: DRM::GREEN, notes: 'Article can be used Worldwide'));
$articleDTO->setLocale('en');
$articleDTO->setSlug('example-article-slug');
$articleDTO->setSiteName('Good News Site');
$articleDTO->setPublishedDate('2023-02-08T15:00:39+00:00');
$articleDTO->setUpdatedDate('2023-02-08T17:00:39+00:00');
$articleDTO->setTitle('Example Article Title');
$articleDTO->setDescription('Example Article Description');
$articleDTO->setUrl('https://www.example.com/recipe');

$articleDTO->setHeroImage(new Image(
    url: 'https://www.example.com/image.jpg',
    alt: 'Hero Image',
    title: 'Image title',
    width: 800, height: 600,
    drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '12345')));

$articleDTO->setThumbnailImage(new Image(
    url: 'https://www.example.com/image.jpg',
    alt: 'Thumb Image',
    title: 'Image title',
    width: 80, height: 60,
    drm: new DRM(status: DRM::YELLOW, notes: 'Restricted to UK only', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '12346')));

$articleDTO->setTags(new Tag(name: 'article tag 1', slug: 'article-tag-1', notes: 'optional tag notes'));
$articleDTO->setTags(new Tag(name: 'article tag 2', slug: 'article-tag-2', notes: 'optional tag notes'));

$articleDTO->setCategories(new Category(name: 'TV', slug: 'tv', notes: 'optional category notes'));
$articleDTO->setCategories(new Category(name: 'News', slug: 'news', notes: 'optional category notes'));

$articleDTO->setHtml('<p>Example Article Body with full markup</p>');

$articleDTO->setImage(new Image(
    url: 'https://www.example.com/image.jpg',
    alt: 'Article Image',
    title: 'Article title',
    width: 800, height: 600,
    drm: new DRM(status: DRM::GREEN, notes: 'Free to use worldwide', creator: 'Copyright Holder', agency: 'Copyright Agency', damId: '12345')));


// Throws exception if the DTO is not valid
$articleDTO->validate();

// Returns the DTO as a JSON string
echo $articleDTO->toJSON(JSON_PRETTY_PRINT);




```
</details>

<details>
  <summary>Article JSON Output</summary>

```json
{
  "BASE_DTO_VERSION": "1.0.4",
  "type": "article",
  "clientRef": "ABC123",
  "title": "Example Article Title",
  "siteName": "Good News Site",
  "url": "https:\/\/www.example.com\/recipe",
  "slug": "example-article-slug",
  "description": "Example Article Description",
  "publishedDate": "2023-02-08T15:00:39+00:00",
  "updatedDate": "2023-02-08T17:00:39+00:00",
  "locale": "en",
  "drm": {
    "status": 1,
    "notes": "Article can be used Worldwide",
    "creator": "unknown",
    "agency": "unknown",
    "damId": ""
  },
  "author": {
    "name": "Adam Lambourne",
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
    "isUpscaled": false,
    "srcImage": "",
    "exif": [],
    "labels": [],
    "objects": [],
    "drm": {
      "status": 1,
      "notes": "Free to use worldwide",
      "creator": "Copyright Holder",
      "agency": "Copyright Agency",
      "damId": "12345"
    }
  },
  "thumbnailImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Thumb Image",
    "title": "Image title",
    "width": 80,
    "height": 60,
    "isUpscaled": false,
    "srcImage": "",
    "exif": [],
    "labels": [],
    "objects": [],
    "drm": {
      "status": 2,
      "notes": "Restricted to UK only",
      "creator": "Copyright Holder",
      "agency": "Copyright Agency",
      "damId": "12346"
    }
  },
  "tags": [
    {
      "name": "article tag 1",
      "slug": "article-tag-1",
      "notes": "optional tag notes"
    },
    {
      "name": "article tag 2",
      "slug": "article-tag-2",
      "notes": "optional tag notes"
    }
  ],
  "categories": [
    {
      "name": "TV",
      "slug": "tv",
      "notes": "optional category notes"
    },
    {
      "name": "News",
      "slug": "news",
      "notes": "optional category notes"
    }
  ],
  "ARTICLE_DTO_VERSION": "1.0.1",
  "text": "Example Article Body with full markup",
  "html": "<p>Example Article Body with full markup<\/p>",
  "images": [
    {
      "url": "https:\/\/www.example.com\/image.jpg",
      "alt": "Article Image",
      "title": "Article title",
      "width": 800,
      "height": 600,
      "isUpscaled": false,
      "srcImage": "",
      "exif": [],
      "labels": [],
      "objects": [],
      "drm": {
        "status": 1,
        "notes": "Free to use worldwide",
        "creator": "Copyright Holder",
        "agency": "Copyright Agency",
        "damId": "12345"
      }
    }
  ]
}
```
</details>

---


###  Map JSON to DTO

```php
// To Map received JSON data to DTO
$recipeDTO = new RecipeDTO();
$recipeDTO->map($jsonData);
$recipeDTO->validate();
```


