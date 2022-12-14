<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class App {
  public function __construct(
    protected Router $router,
    protected array $request
  ) {
  }

  public function run() {
    try {
      echo $this->router->resolve(
        $this->request['uri'],
        strtolower($this->request['method'])
      );
    } catch (RouteNotFoundException) {
      echo View::make('error/404');
    }
  }
}
