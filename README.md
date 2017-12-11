# Mapbox API for Laravel 5+

[![Build Status](https://travis-ci.org/BlueVertex/mapbox-api-laravel.svg)](https://travis-ci.org/BlueVertex/mapbox-api-laravel)

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

**Laravel 5.4+**

The service provider should be automatically registered.

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

**Retrieve Dataset**

```
$dataset = Mapbox::datasets($datasetID)->get();
```

**Update Dataset**

```
$dataset = Mapbox::datasets($datasetID)->update([
	'name' => 'My Dataset Updated',
	'description' => 'This is my latest dataset'
]);
```

**Delete Dataset**

```
$response = Mapbox::datasets($datasetID)->delete();
```

**List Feature**

```
$response = Mapbox::datasets($datasetID)->features()->list();
```

**Insert or Update Feature**

```
$response = Mapbox::datasets($datasetID)->features()->add($feature);
```

**Retrieve Feature**

```
$response = Mapbox::datasets($datasetID)->features($featureID)->get();
```

**Delete Feature**

```
$response = Mapbox::datasets($datasetID)->features($featureID)->delete();
```

