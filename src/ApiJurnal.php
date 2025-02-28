<?php

namespace Idaravel\KlienApijurnal;

class ApiJurnal extends BackEnd {

  public $kunci, $nama_projek, $info;

  public function __construct(){
    $this->setData($this->auth());
  }

  public function inputJurnal($kode, Array $data){
    return $this->reqPost("jurnal/input", [
      'kode' => $kode,
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function getJurnal($tgl_awal, $tgl_akhir){
    return $this->reqPost("jurnal", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'tgl_awal' => $tgl_awal,
        'tgl_akhir' => $tgl_akhir
      ]
    ]);
  }

  public function getBukuBesar($periode, $no_perkiraan){
    return $this->reqPost("buku_besar", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'periode' => $periode,
        'no_perkiraan' => $no_perkiraan
      ]
    ]);
  }

  public function getLabaRugi($periode, $unit){
    return $this->reqPost("lr", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'periode' => $periode,
        'unit' => $unit
      ]
    ]);
  }

  public function getNeraca($periode, $unit){
    return $this->reqPost("neraca", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'periode' => $periode,
        'unit' => $unit
      ]
    ]);
  }

  private function setData($res){
    $data = $res->data;
    $this->info = $res->info;

    $this->kunci = $data->kunci_projek;
    $this->nama_projek = $data->nama_projek;
  }
}
