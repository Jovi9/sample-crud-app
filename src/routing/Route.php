<?php

/**
 * Do not edit the existing codes in this file
 * If need be you can add new methods for your use
 */

namespace Routing;

class Route
{
     private array $handlers;
     private const METHOD_POST = 'POST';
     private const METHOD_GET = 'GET';
     private $notFoundHandler;

     private function modifyPath(string $path): string
     {
          $newPath = '/' . rtrim($path, '/');
          // $leadingSlash = substr($newPath, 0, 1);
          // if (!($leadingSlash === '/')) {
          //      // $newPath = substr_replace($newPath, '', 0);
          //      $newPath = '/' . $newPath;
          // }
          return $newPath;
     }

     private function add(string $method, string $path, $handler)
     {
          $path = $this->modifyPath($path);
          $this->handlers[$method . $path] = [
               'path' => $path,
               'method' => $method,
               'handler' => $handler
          ];
     }
     public function get(string $path, $handler): void
     {
          $this->add(self::METHOD_GET, $path, $handler);
     }
     public function post(string $path, $handler): void
     {
          $this->add(self::METHOD_POST, $path, $handler);
     }

     public function addNotFoundHandler($handler): void
     {
          $this->notFoundHandler = $handler;
     }

     public function run()
     {
          $requestUrl = parse_url($_SERVER['REQUEST_URI']);
          $requestPath = $requestUrl['path'];
          $method = $_SERVER['REQUEST_METHOD'];
          $callback = null;
          foreach ($this->handlers as $handler) {
               if ($handler['path'] === $requestPath && $method === $handler['method']) {
                    $callback = $handler['handler'];
               }
          }

          if (is_string($callback)) {
               $parts = explode('::', $callback);
               if (is_array($parts)) {
                    $className = array_shift($parts);
                    $handler = new $className;

                    $method = array_shift($parts);
                    $callback = [$handler, $method];
               }
          }

          if (!$callback) {
               header('HTTP/1.0 404 Not Found');
               if (!empty($this->notFoundHandler)) {
                    $callback = $this->notFoundHandler;
               }
          }

          call_user_func_array($callback, [
               array_merge($_GET, $_POST)
          ]);
     }
}
