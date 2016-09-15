<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Fathi
 * Date: 9/3/2016
 * Time: 6:27 PM
 */


// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.defaultPageName'), route('home'));
});

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.dashboard.defaultPageName'), route('dashboard'));
});




// Dashboard > Categories
Breadcrumbs::register('categories.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('categories.name'), route('categories.index'));
});

// Dashboard > Categories > Create Category
Breadcrumbs::register('categories.create', function($breadcrumbs)
{
    $breadcrumbs->parent('categories.index');
    $breadcrumbs->push(trans('app.create'), route('categories.create'));
});

// Dashboard > Categories > [Category Name]
Breadcrumbs::register('categories.show', function($breadcrumbs, $category)
{
    $breadcrumbs->parent('categories.index');
    $breadcrumbs->push($category->title, route('categories.show', $category->slug));
});

// Dashboard > Categories > [Category Name] > Edit Category
Breadcrumbs::register('categories.edit', function($breadcrumbs, $category)
{
    $breadcrumbs->parent('categories.show', $category);
    $breadcrumbs->push(trans('app.update'), route('categories.edit', $category->slug));
});
// Dashboard > Categories > Settings
Breadcrumbs::register('categories.settings', function($breadcrumbs)
{
    $breadcrumbs->parent('categories.index');
    $breadcrumbs->push(trans('categories.settings'), route('categories.settings'));
});





// Dashboard > Seeds
Breadcrumbs::register('seeds.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('seeds.name'), route('seeds.index'));
});

// Dashboard > Seeds > Create Seed
Breadcrumbs::register('seeds.create', function($breadcrumbs)
{
    $breadcrumbs->parent('seeds.index');
    $breadcrumbs->push(trans('app.create'), route('seeds.create'));
});

// Dashboard > Seeds > [Seed Name]
Breadcrumbs::register('seeds.show', function($breadcrumbs, $seed)
{
    $breadcrumbs->parent('seeds.index');
    $breadcrumbs->push($seed->title, route('seeds.show', $seed->slug));
});

// Dashboard > Seeds > [Seed Name] > Edit Seed
Breadcrumbs::register('seeds.edit', function($breadcrumbs, $seed)
{
    $breadcrumbs->parent('seeds.show', $seed);
    $breadcrumbs->push(trans('app.update'), route('seeds.edit', $seed->slug));
});
// Dashboard > Seeds > Settings
Breadcrumbs::register('seeds.settings', function($breadcrumbs)
{
    $breadcrumbs->parent('seeds.index');
    $breadcrumbs->push(trans('seeds.settings'), route('seeds.settings'));
});





// Dashboard > Feeds
Breadcrumbs::register('feeds.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('feeds.name'), route('feeds.index'));
});

// Dashboard > Feeds > Create Seed
Breadcrumbs::register('feeds.create', function($breadcrumbs)
{
    $breadcrumbs->parent('feeds.index');
    $breadcrumbs->push(trans('app.create'), route('feeds.create'));
});

// Dashboard > Feeds > [Feed Name]
Breadcrumbs::register('feeds.show', function($breadcrumbs, $seed)
{
    $breadcrumbs->parent('feeds.index');
    $breadcrumbs->push($seed->title, route('feeds.show', $seed->slug));
});

// Dashboard > Feeds > [Feed Name] > Edit Feed
Breadcrumbs::register('feeds.edit', function($breadcrumbs, $seed)
{
    $breadcrumbs->parent('feeds.show', $seed);
    $breadcrumbs->push(trans('app.update'), route('feeds.edit', $seed->slug));
});
// Dashboard > Feeds > Settings
Breadcrumbs::register('feeds.settings', function($breadcrumbs)
{
    $breadcrumbs->parent('feeds.index');
    $breadcrumbs->push(trans('feeds.settings'), route('feeds.settings'));
});
