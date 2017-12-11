# Mapbox API for Laravel 5+

[![Build Status](https://travis-ci.org/BlueVertex/mapbox-api-laravel.svg)](https://travis-ci.org/BlueVertex/mapbox-api-laravel)
[![Latest Stable Version](https://poser.pugx.org/bluevertex/mapbox-api-laravel/v/stable)](https://packagist.org/packages/bluevertex/mapbox-api-laravel)
[![Latest Unstable Version](https://poser.pugx.org/bluevertex/mapbox-api-laravel/v/unstable)](https://packagist.org/packages/bluevertex/mapbox-api-laravel)
[![Monthly Downloads](https://poser.pugx.org/bluevertex/mapbox-api-laravel/d/monthly)](https://packagist.org/packages/bluevertex/mapbox-api-laravel)
[![License](https://poser.pugx.org/bluevertex/mapbox-api-laravel/license)](https://packagist.org/packages/bluevertex/mapbox-api-laravel)

A [Laravel](https://laravel.com/) 5+ Package for managing [Mapbox](https://www.mapbox.com/api-documentation/) Datasets and Tilesets

This library supports the listing, creation, and deletion of the following types via the Mapbox API:

1. [Datasets](https://www.mapbox.com/api-documentation/#datasets)
2. [Tilesets](https://www.mapbox.com/api-documentation/#tilesets)
3. [Uploads](https://www.mapbox.com/api-documentation/#uploads)

## Installation

**Install Via Composer:**
```
composer require bluevertex/mapbox-api-laravel
```

**Laravel 5.5+**

The service provider should be automatically registered.

**Laravel ≤ 5.4 and Lumen:**
```
// Laravel: config/app.php
BlueVertex\MapBoxAPILaravel\MapBoxAPILaravelServiceProvider::class
```

```
// Lumen: bootstrap/app.php
$app->register(BlueVertex\MapBoxAPILaravel\MapBoxAPILaravelServiceProvider::class);
```

```
// Facade Alias
'Mapbox' => BlueVertex\MapBoxAPILaravel\Facades\Mapbox::class,
```

## Configuration

Add the following to your `.env` file:

```
MAPBOX_ACCESS_TOKEN=[Your Mapbox Access Token]
MAPBOX_USERNAME=[Your Mapbox Username]
```

*Note: Make sure your Access Token has the proper scope for all the operations you need to perform.*

## Usage

### Datasets

**List Datasets:**
```
$list = Mapbox::datasets()->list();
```

**Create Dataset:**
```
$dataset = Mapbox::datasets()->create([
	'name' => 'My Dataset',
	'description' => 'This is my dataset'
]);
```

**Retrieve Dataset:**
```
$dataset = Mapbox::datasets($datasetID)->get();
```

**Update Dataset:**
```
$dataset = Mapbox::datasets($datasetID)->update([
	'name' => 'My Dataset Updated',
	'description' => 'This is my latest dataset'
]);
```

**Delete Dataset:**
```
$response = Mapbox::datasets($datasetID)->delete();
```

**List Feature:**
```
$response = Mapbox::datasets($datasetID)->features()->list();
```

**Insert or Update Feature:**
```
$response = Mapbox::datasets($datasetID)->features()->add($feature);
```

**Retrieve Feature:**
```
$response = Mapbox::datasets($datasetID)->features($featureID)->get();
```

**Delete Feature:**
```
$response = Mapbox::datasets($datasetID)->features($featureID)->delete();
```

### Tilesets

**List Tilesets:**
```
// Options array is optional
$list = Mapbox::tilesets()->list([
	'type' 			=> 'raster',
	'visibility' 	=> 'public',
	'sortby' 		=> 'modified',
	'limit' 		=> 500
]);
```

### Uploads

**Get S3 Credentials:**
```
// Returns S3Credentials Object
$response = Mapbox::uploads()->credentials();
```

**Create Upload:**
```
$response = Mapbox::uploads()->create([
	'tileset' => '{username}.mytilesetid',
	'url' => 'mapbox://datasets/{username}/{dataset}', // Or S3 Bucket URL from S3Credentials Object
	'name' => 'Upload Name'
]);
```

**Retrieve Upload Status:**
```
$response = Mapbox::uploads($uploadID)->get();
```

**List Upload Statuses:**
```
$list = Mapbox::uploads()->list();
```

**Delete Upload:**
```
$response = Mapbox::uploads($uploadID)->delete();
```

