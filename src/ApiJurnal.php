<?php

namespace Idaravel\KlienApijurnal;

class ApiJurnal extends BackEnd {

  public $kunci, $id_projek, $nama_projek, $info;

  public function __construct(){
    $this->setData($this->auth());
  }

  public function getCoa($data = []){
    return $this->reqPost("coa", [
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function inputCoa(Array $data){
    return $this->reqPost("coa/input", [
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function updateCoa(Array $data){
    return $this->reqPost("coa/update", [
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function deleteCoa(Array $data){
    return $this->reqPost("coa/delete", [
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function inputKeu(Array $data){
    return $this->reqPost("jurnal/inputDinamis", [
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function inputJurnal($kode, Array $data){
    return $this->reqPost("jurnal/input", [
      'kode' => $kode,
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function inputJu(Array $data){
    return $this->reqPost("jurnal/input2", [
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function getJurnal(Array $data){
    return $this->reqPost("jurnal", [
      'kunci_projek' => $this->kunci,
      'data' => $data
    ]);
  }

  public function getBukuBesar($periode, $no_perkiraan, $unit = null){
    return $this->reqPost("buku_besar", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'periode' => $periode,
        'no_perkiraan' => $no_perkiraan,
        'unit' => $unit
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

  public function tutupGl($periode){
    return $this->reqPost("tutupgl", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'periode' => $periode
      ]
    ]);
  }

  public function inputCafe(array $komposisi, array $barang, string $metode_bayar){
    return $this->reqPost("cafe", [
      'kunci_projek' => $this->kunci,
      'data' => [
        "komposisi" => $komposisi,
        "barang" => $barang,
        "mbayar" => $metode_bayar
      ]
    ]);
  }

  public function getNeracaSaldo($periode, $unit){
    return $this->reqPost("neraca/ncs", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'periode' => $periode,
        'unit' => $unit
      ]
    ]);
  }

  public function getNeraca($periode, $unit, $konsolidasi = null){
    return $this->reqPost("neraca", [
      'kunci_projek' => $this->kunci,
      'data' => [
        'periode' => $periode,
        'unit' => $unit,
        'konsolidasi' => $konsolidasi
      ]
    ]);
  }

  private function setData($res){
    if(!isset($res->data->kunci_projek)){
      return response()->json([
        'info' => [
          'pesan' => 'KUNCI PROJEK TIDAK VALID.',
          'kode_permintaan' => 403
        ], 'data' => null
      ], 403, [], JSON_PRETTY_PRINT);
    }
    $data = $res->data;
    $this->info = $res->info;

    $this->kunci = $data->kunci_projek;
    $this->nama_projek = $data->nama_projek;
    $this->id_projek = $data->id_projek;
    $this->unit = $data->unit;
  }
}
