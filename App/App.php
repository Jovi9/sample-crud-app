<?php

namespace App;

const BASE_URI = "http://localhost/crud-app/";

class App
{
     public static function getBaseUri(): string
     {
          return BASE_URI;
     }

     public static function getBaseDir(): string
     {
          return __DIR__ . "/../";
     }

     public static function env(): array
     {
          $env = parse_ini_file(self::getBaseDir() . '.env');
          return array(
               "APP_NAME" => $env['APP_NAME'],
               "DB_CONNECTION" => $env['DB_CONNECTION'],
               "DB_HOST" => $env['DB_HOST'],
               "DB_PORT" => $env['DB_PORT'],
               "DB_DATABASE" => $env['DB_DATABASE'],
               "DB_USERNAME" => $env['DB_USERNAME'],
               "DB_PASSWORD" => $env['DB_PASSWORD']
          );
     }

     public static function getAppName(): string
     {
          return self::env()["APP_NAME"];
     }

     public static function getSession(): string
     {
          return 'auth' . str_replace(' ', '_', self::env()['APP_NAME']);
     }

     public static function userSessionData(): string
     {
          return 'auth' . str_replace(' ', '_', self::env()['APP_NAME']) . 'user';
     }

     /*
     Define routing pages for application
     */
     public static function routes(): array
     {
          return array(
               'index' => BASE_URI,
               'login' => BASE_URI . 'login/',
               'register' => BASE_URI . 'register/',
               'dashboard' => BASE_URI . 'dashboard/',
               'logout' => BASE_URI . 'logout/',
               'profile' => BASE_URI . 'profile/',
               'edit-profile' => BASE_URI . 'profile/edit/',

               'edit-user' => BASE_URI . 'edit_user/',
          );
     }
}
