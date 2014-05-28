<?php namespace Brunoquaresma\LaravelDBSearch;

use Illuminate\Support\ServiceProvider;

class LaravelDBSearchServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('brunoquaresma/laravel-dbsearch');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{	
		$this->app->booting(function()
		{
		  $loader = \Illuminate\Foundation\AliasLoader::getInstance();
		  $loader->alias('LaravelDBSearchServiceProvider', 'Brunoquaresma\LaravelDBSearch\Facades\LaravelDBSearch');
		});
		
		$this->app['laraveldbsearch'] = $this->app->share(function($app)
		{
			return new LaravelDBSearch;
		}); 	  
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('LaravelDBSearch');
	}

}
