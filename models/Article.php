<?php

class Article {
    private ?int $id;
    private ?string $title;
    private ?string $short_description;
    private ?string $content;
    private ?string $publish_date;

    public function __construct(
        ?int    $id,
        ?string $title,
        ?string $short_desc = null,
        ?string $content = null,
        ?string $publish_date = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->short_description = $short_desc;
        $this->content = $content;
        $this->publish_date = $publish_date;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getShortDesc(): ?string
    {
        return $this->short_description;
    }

    public function setShortDesc(?string $short_description): void
    {
        $this->short_description = $short_description;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getPublishDate(): ?string
    {
        return $this->publish_date;
    }

    public function setPublishDate(?string $publish_date): void
    {
        try {
            $dateObj = new DateTime($publish_date);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $this->publish_date = $dateObj->format('Y-m-d');
    }
}