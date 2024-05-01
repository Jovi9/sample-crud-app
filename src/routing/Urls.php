<?php

/**
 * Do not edit the existing codes in this file
 * If need be you can add new methods for your use
 */

namespace Routing;

use Exception;

class Urls
{
     private static array $urls;

     public static function set(string $name, string $path)
     {
          if (!isset(self::$urls[$name])) {
               self::$urls[$name] = [
                    'name' => $name,
                    'url' => $path,
               ];
          } else {
               throw new Exception("Duplicate route name.");
          }
     }
     public static function get(string $name): string
     {
          return self::$urls[$name]['url'];
     }
     public static function routes(): array
     {
          return self::$urls;
     }
}
