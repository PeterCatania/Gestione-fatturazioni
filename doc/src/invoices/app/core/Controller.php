<?php
/**
 * @author Peter Catania
 * @version 22.10.2019
 *
 * Provides the functionality of a cotroller.
 */
class Controller
{
  /**
   * Import and return an istance of a Model.
   *
   * @param $model The Model to import
   * @return $model The instance of the Model imported
   */
  protected function model($model)
  {
    require_once 'app/models/' . $model . '.php';
    return new $model();
  }

  /**
   * Import a view.
   *
   * @param view The view to import
   * @param view The data that is needed for the view
   * @return void
   */
  protected function view($view, $data = [])
  {
    require 'app/views/' . $view . '.php';
  }
}
