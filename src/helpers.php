<?php

/**
 * Do not edit the existing codes in this file
 * If need be you can add new methods for your use
 */

use App\App;
use Routing\Urls;

// session
function appSession(): bool
{
     if (isset($_SESSION[App::setSession()])) {
          return true;
     }
     return false;
}
function appSessionData(): array
{
     return (isset($_SESSION[App::setSessionData()])) ? $_SESSION[App::setSessionData()] : null;
}

function auth()
{
     if (appSession() === false) {
          header("location:" . route('login'));
          exit();
     }
}
function guest()
{
     if (appSession() === true) {
          header("location:" . route('dashboard'));
          exit();
     }
}

function baseUrl()
{
     return App::baseUrl();
}

const FROM_ROUTE = 'route';
// get route url
function route(string $name, $from = null): string
{
     $url = Urls::get($name);
     return ($from === FROM_ROUTE) ?  $url : baseUrl() . $url;
}
function routeSet(string $name, string $path): string
{
     Urls::set($name, $path);
     return $path;
}

function requestChecker($request)
{
     if ($request != null) {
          foreach ($request as $key => $value) {
               unset($request[$key]);
          }
          header('HTTP/1.0 404 Not Found');
          require view('errors/error');
          die();
     }
}

const SUBMISSION_ERROR = 'submission-error';
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
function getMethodChecker($request, $key, $url, $count = 1)
{
     $valid = false;
     if (is_array($key)) {
          foreach ($key as $ky) {
               if (count($request) > $count) {
                    $valid = false;
                    break;
               }
               if (array_key_exists($ky, $request)) {
                    $valid = true;
               } else {
                    $valid = false;
                    break;
               }
          }
     } else {
          if (array_key_exists($key, $request)) {
               if (count($request) > $count) {
                    $valid = false;
               } else {
                    $valid = true;
               }
          }
     }
     if ($valid === false) {
          foreach ($request as $key => $value) {
               unset($request[$key]);
          }
          header('HTTP/1.0 404 Not Found');
          require view('errors/error');
          die();
     }
}

const BASE_DIRECTORY = __DIR__ . '/../';
// get directory
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

// public resources i.e. css, js, images
function assets(string $src): string
{
     return App::baseUrl() . $src;
}

// returning view files
function view(string $view): string
{
     return getDirectory()['views'] . $view . '.php';
}

// include files
function project_file(string $directory, string $name): string
{
     return getDirectory()[$directory] . $name . '.php';
}

function message($key): string
{
     $message = '';
     if (isset($_SESSION[$key])) {
          $message = $_SESSION[$key];
          unset($_SESSION[$key]);
     }
     return $message;
}
