<?php

/**
 * It is not recommended to edit the codes in this file.
 */

use App\App;
use Routing\Urls;

/**
 * Get the current active session || if user is authenticated
 */
function appSession(): bool
{
     if (isset($_SESSION[App::setSession()])) {
          return true;
     }
     return false;
}
/**
 * Get Authenticated user session data (e.g. name, username)
 */
function appSessionData(): array
{
     return (isset($_SESSION[App::setSessionData()])) ? $_SESSION[App::setSessionData()] : null;
}

/**
 * Prevent accessing pages that are only available to authenticated and unathenticated users
 * Check if user is authenticated if not redirect to login page
 */
function auth()
{
     if (appSession() === false) {
          header("location:" . route('login'));
          exit();
     }
}
/**
 * Prevent accessing pages that are only available to authenticated and unathenticated users
 * Check if user is authenticated if so redirect to dashboard
 */
function guest()
{
     if (appSession() === true) {
          header("location:" . route('dashboard'));
          exit();
     }
}

/**
 * Get the base url provided from the env variable
 */
function baseUrl()
{
     return App::baseUrl();
}

/**
 * Will be used if the requesting url is from the route page
 */
const FROM_ROUTE = 'route';
/**
 * Used to get the url provided in the routes and for redirecting headers location
 */
function route(string $name, $from = null): string
{
     $url = Urls::get($name);
     return ($from === FROM_ROUTE) ?  $url : baseUrl() . $url;
}
/**
 * Set the url route in the routes.php, will throw an error if duplicate name
 */
function routeSet(string $name, string $path): string
{
     Urls::set($name, $path);
     return $path;
}

const SUBMISSION_ERROR = 'submission-error';
/**
 * Check if the post request contains the key that binds all the request, $_POST is usually used to get all the post request values
 * In order to verify if the post key exists you will invoke the function
 * postMethodChecker($request, 'login', route('login'))
 * if the login post key do not exist the page will be redirected to the url and a submission error will be passed and displayed in the view if the message() has been invoked
 */
function postMethodChecker($request, $key, $url)
{
     if (!isset($request[$key])) {
          foreach ($request as $key => $value) {
               unset($request[$key]);
          }
          $_SESSION[SUBMISSION_ERROR] = "Failed to submit request, please try again.";
          header("location:" . route($url));
          exit();
     }
}
/**
 * Check if the get request key exists, when getting get request usually used $_GET[$key]
 * In order to verify if the key exists you will invoke the function
 * getMethodChecker($request, 'id', route('user'));
 * if the id key in the get request do not exists the page will be redirected to user url.
 */
function getMethodChecker($request, $key, $url)
{
     if (!isset($request[$key])) {
          foreach ($request as $key => $value) {
               unset($request[$key]);
          }
          header("location:" . route($url));
          exit();
     }
}

const BASE_DIRECTORY = __DIR__ . '/../';
/**
 * Get all the directories in the project including subfolders.
 */
function getDirectory(string $base = BASE_DIRECTORY): array
{
     $directories = scandir($base);
     $dirPaths = [];
     foreach ($directories as $directory) {
          $path = $base . $directory . '/';
          if ($directory !== '.' && $directory !== '..') {
               if (is_dir($path) &&  $directory !== 'vendor' && $directory !== '.git') {
                    $dirPaths[$directory] = $path;
                    $dirPaths = array_merge($dirPaths, getDirectory($path));
               }
          }
     }
     return $dirPaths;
}

/**
 * Including assets in the views pages
 * By default asset gets the contents in the public directory
 * Usage, if you have style.css located at public/css directory you will invoke the function
 * assets('css/style.css')
 */
function assets(string $src): string
{
     return App::baseUrl() . $src;
}

/**
 * Used to require view files in the controllers
 * By default view() gets the contents in the views directory
 * Usage, if you have login view located at views/auth directory you will invoke the function
 * require view('auth/login')
 */
function view(string $view): string
{
     return getDirectory()['views'] . $view . '.php';
}

/**
 * Used to include php files anywhere in the project
 * The function requires two arguments, first argument is the directory and second argument is for the name of the file you want to include
 * Usage, if you have custom-include.php file located at src/includes directory you will invoke the function
 * include project_file('includes', 'custom-include')
 */
function project_file(string $directory, string $name): string
{
     return getDirectory()[$directory] . $name . '.php';
}

/**
 * Used to check for $_SESSION variables if available, usually when passing message (errors / success) indicators, the message is stored in $_SESSION variable
 * Usage, if you have a success message after performing registration with the key success-registration you will invoke the function
 * $message = message('success-registration');
 * <?= $message; ?>
 */
function message($key): string
{
     $message = '';
     if (isset($_SESSION[$key])) {
          $message = $_SESSION[$key];
          unset($_SESSION[$key]);
     }
     return $message;
}
