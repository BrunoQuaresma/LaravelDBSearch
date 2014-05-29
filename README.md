LaravelDBSearch
===============

A simple package for full text search using the Laravel's Eloquent.

1. [Required setup](#required-setup)
2. [Basic usage](#basic-usage)
3. [Use join](#use-join)

### Required setup

In the `require` key of `composer.json` file add the following

    "brunoquaresma/laravel-dbsearch": "dev-master"

Run the Composer update comand

    $ composer update

In your `config/app.php` add `'Brunoquaresma\LaravelDBSearch\LaravelDBSearchServiceProvider'` to the end of the `$providers` array

```php
'providers' => array(

    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    ...
    'Brunoquaresma\LaravelDBSearch\LaravelDBSearchServiceProvider',

),
```

At the end of `config/app.php` add `'Entrust'    => 'Zizaco\Entrust\EntrustFacade'` to the `$aliases` array

```php
'aliases' => array(

    'App'        => 'Illuminate\Support\Facades\App',
    'Artisan'    => 'Illuminate\Support\Facades\Artisan',
    ...
    'LaravelDBSearch' => 'Brunoquaresma\LaravelDBSearch\Facades\LaravelDBSearch'

),
```

###Basic usage

For this example we use a course model.

```php
$courses =  LaravelDBSearch::model('Course')			
				->field(array('name', 'description'))
				->query('php')
				->get();
```

1. model() - Set the default model for the search.
2. field() - Set the search fields by array or a string value if have only one field.
3. query() - Set the search query value.
4. get()   - Get the results of search.

###Use join

Get the courses where the owner have a name with `John`.

```php
$courses =  LaravelDBSearch::model('Course')			
				->field(array('name', 'description', 'first_name', 'last_name', 'username'))
				->join('courses.*', 'users', 'courses.user_id', '=', 'users.id')
				->query('John')
				->get();
```







