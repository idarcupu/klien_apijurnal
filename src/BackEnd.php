<?php

namespace Idaravel\KlienApijurnal;

use Illuminate\Support\Facades\Http;

class BackEnd {

  protected function konfigurasi(){
    return [
      'base_url' => env('APIJURNAL_URL', ''),
      'email' => env('APIJURNAL_EMAIL', ''),
      'password' => env('APIJURNAL_PASSWORD', ''),
      'projek_id' => env('APIJURNAL_PROJEK_ID', '')
    ];
  }

  protected function auth(){
    return $this->reqPost('autentikasi', $this->konfigurasi());
  }

  protected function reqPost($path, $data){
    $url = $this->path($path);

    try {
      $payload = Http::post($url, $data)->json();
    } catch (\Exception $e) {
      abort(403, 'konfigurasi api-jurnal tidak valid.');
    }

    return $this->ubahObjek($payload);
  }

  protected function ubahObjek($data){
    return json_decode(json_encode($data, JSON_PRETTY_PRINT));
  }

  protected function path($path){
    return env('APIJURNAL_URL').$path;
  }
}
