<?php
/**
* @author Peter Catania
* @version 22.10.2019
*
* Controller for the registration.
*/
class Registration extends Controller
{
  /**
   * Empty constructor.
   */
  public function __construct(){}

  /**
  * Method that comunicate with the default page.
  */
  public function index()
  {
    $this->view('registration/index');
  }

  /**
  * Effetuate the login, and redirect to the next view.
  */
  public function register()
  {
    /** Effetuate the login, if is submit a POST request */
    if (isset($_POST['register'])) {

    }
  }
}
