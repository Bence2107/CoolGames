<?php

class Game {
    private ?int $id;
    private ?string $nev;
    private ?string $fejleszto;
    private ?string $kiado;
    private ?string $mufaj;
    private ?string $r_leiras; // rövid leírás
    private ?string $h_leiras; // hosszú leírás
    private ?string $video_link;
    private ?string $megjelenes_datum;
    private float $ertekeles;
    private float $eredeti_ertekeles;
    private int $ar;

    public function __construct(?int $id, ?string $nev, ?string $fejleszto, ?string $kiado, ?string $mufaj, ?string $r_leiras, ?string $h_leiras, ?string $video_link, ?string $megjelenes_datum, float $ertekeles, float $eredeti_ertekeles, int $ar)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->fejleszto = $fejleszto;
        $this->kiado = $kiado;
        $this->mufaj = $mufaj;
        $this->r_leiras = $r_leiras;
        $this->h_leiras = $h_leiras;
        $this->video_link = $video_link;
        $this->megjelenes_datum = $megjelenes_datum;
        $this->ertekeles = $ertekeles;
        $this->eredeti_ertekeles = $eredeti_ertekeles;
        $this->ar = $ar;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNev(): ?string
    {
        return $this->nev;
    }

    public function setNev(?string $nev): void
    {
        $this->nev = $nev;
    }

    public function getFejleszto(): ?string
    {
        return $this->fejleszto;
    }

    public function setFejleszto(?string $fejleszto): void
    {
        $this->fejleszto = $fejleszto;
    }

    public function getKiado(): ?string
    {
        return $this->kiado;
    }

    public function setKiado(?string $kiado): void
    {
        $this->kiado = $kiado;
    }

    public function getMufaj(): ?string
    {
        return $this->mufaj;
    }

    public function setMufaj(?string $mufaj): void
    {
        $this->mufaj = $mufaj;
    }

    public function getRLeiras(): ?string
    {
        return $this->r_leiras;
    }

    public function setRLeiras(?string $r_leiras): void
    {
        $this->r_leiras = $r_leiras;
    }

    public function getHLeiras(): ?string
    {
        return $this->h_leiras;
    }

    public function setHLeiras(?string $h_leiras): void
    {
        $this->h_leiras = $h_leiras;
    }

    public function getVideoLink(): ?string
    {
        return $this->video_link;
    }

    public function setVideoLink(?string $video_link): void
    {
        $this->video_link = $video_link;
    }

    public function getMegjelenesDatum(): ?string
    {
        return $this->megjelenes_datum;
    }

    public function setMegjelenesDatum(?string $megjelenes_datum): void
    {
        $this->megjelenes_datum = $megjelenes_datum;
    }

    public function getErtekeles(): float
    {
        return $this->ertekeles;
    }

    public function setErtekeles(float $ertekeles): void
    {
        $this->ertekeles = $ertekeles;
    }

    public function getEredetiErtekeles(): float
    {
        return $this->eredeti_ertekeles;
    }

    public function setEredetiErtekeles(float $eredeti_ertekeles): void
    {
        $this->eredeti_ertekeles = $eredeti_ertekeles;
    }

    public function getAr(): int
    {
        return $this->ar;
    }

    public function setAr(int $ar): void
    {
        $this->ar = $ar;
    }




}