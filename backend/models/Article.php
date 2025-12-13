<?php

class Article {
    private ?int $id;
    private ?string $cim;
    private ?string $rovid_leiras;
    private ?string $tartalom;
    private ?string $datum;

    public function __construct(
        ?int $id,
        ?string $cim,
        ?string $rovid_leiras = null,
        ?string $tartalom = null,
        ?string $datum = null)
    {
        $this->id = $id;
        $this->cim = $cim;
        $this->rovid_leiras = $rovid_leiras;
        $this->tartalom = $tartalom;
        $this->datum = $datum;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCim(): ?string
    {
        return $this->cim;
    }

    public function setCim(?string $cim): void
    {
        $this->cim = $cim;
    }

    public function getRovidLeiras(): ?string
    {
        return $this->rovid_leiras;
    }

    public function setRovidLeiras(?string $rovid_leiras): void
    {
        $this->rovid_leiras = $rovid_leiras;
    }

    public function getTartalom(): ?string
    {
        return $this->tartalom;
    }

    public function setTartalom(?string $tartalom): void
    {
        $this->tartalom = $tartalom;
    }

    public function getDatum(): ?string
    {
        return $this->datum;
    }

    public function setDatum(?string $datum): void
    {
        try {
            $dateObj = new DateTime($datum);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $this->datum = $dateObj->format('Y-m-d');
    }
}