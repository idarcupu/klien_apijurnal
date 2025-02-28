<?php

namespace Idaravel\KlienApijurnal;

use Closure;

class Idarware {

  public function handle($request, Closure $next){
    app()->instance(
      ApiJurnal::class,
      InitSistem::make(ApiJurnal::class)
    );

    return $next($request);
  }
}
