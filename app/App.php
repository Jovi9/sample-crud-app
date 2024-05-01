<?php

/**
 * Do not edit the existing codes in this file
 * If need be you can add new methods for your use
 */

namespace App;

class App
{
     public static function baseUrl(): string
     {
          return self::env()['BASE_URL'];
     }

     public static function env(): array
     {
          return parse_ini_file(BASE_DIRECTORY . '.env');
     }

     public static function name(): string
     {
          return self::env()["APP_NAME"];
     }

     public static function setSession(): string
     {
          return 'auth_' . str_replace(' ', '_', self::env()['APP_NAME']);
     }

     public static function setSessionData(): string
     {
          return 'auth_' . str_replace(' ', '_', self::env()['APP_NAME']) . '_user';
     }
}
