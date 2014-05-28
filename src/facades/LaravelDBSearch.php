<?php namespace Brunoquaresma\LaravelDBSearch\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class LaravelDBSearch extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'laraveldbsearch'; }
 
}