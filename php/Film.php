<?php

// Class Film merepresentasikan entity bioskop
class Film {
    private $id;
    private $judul;
    private $genre;
    private $harga;
    private $poster;

    public function __construct($id = "", $judul = "", $genre = "", $harga = 0, $poster = "") {
        $this->id = $id;
        $this->judul = $judul;
        $this->genre = $genre;
        $this->harga = $harga;
        $this->poster = $poster;
    }

    // Getter
    public function getId() { return $this->id; }
    public function getJudul() { return $this->judul; }
    public function getGenre() { return $this->genre; }
    public function getHarga() { return $this->harga; }
    public function getPoster() { return $this->poster; }

    // Setter
    public function setId($id) { $this->id = $id; }
    public function setJudul($judul) { $this->judul = $judul; }
    public function setGenre($genre) { $this->genre = $genre; }
    public function setHarga($harga) { $this->harga = $harga; }
    public function setPoster($poster) { $this->poster = $poster; }
}