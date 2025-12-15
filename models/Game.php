<?php

class Game {
    private ?int $id;
    private ?string $title;
    private ?string $developer;
    private ?string $publisher;
    private ?string $genre;
    private ?string $short_description;
    private ?string $long_description;
    private ?string $video_link;
    private ?string $publish_date;
    private float $rating;
    private float $original_rating;
    private int $price;

    public function __construct(
        ?int    $id,
        ?string $title,
        ?string $developer,
        ?string $publisher,
        ?string $genre,
        ?string $short_desc,
        ?string $long_desc,
        ?string $video_link,
        ?string $publish_date,
        float   $rating,
        float   $original_rating,
        int     $price
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->developer = $developer;
        $this->publisher = $publisher;
        $this->genre = $genre;
        $this->short_description = $short_desc;
        $this->long_description = $long_desc;
        $this->video_link = $video_link;
        $this->publish_date = $publish_date;
        $this->rating = $rating;
        $this->original_rating = $original_rating;
        $this->price = $price;
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

    public function getDeveloper(): ?string
    {
        return $this->developer;
    }

    public function setDeveloper(?string $developer): void
    {
        $this->developer = $developer;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(?string $publisher): void
    {
        $this->publisher = $publisher;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): void
    {
        $this->genre = $genre;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): void
    {
        $this->short_description = $short_description;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(?string $long_description): void
    {
        $this->long_description = $long_description;
    }

    public function getVideoLink(): ?string
    {
        return $this->video_link;
    }

    public function setVideoLink(?string $video_link): void
    {
        $this->video_link = $video_link;
    }

    public function getPublishDate(): ?string
    {
        return $this->publish_date;
    }

    public function setPublishDate(?string $publish_date): void
    {
        $this->publish_date = $publish_date;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    public function getOriginalRating(): float
    {
        return $this->original_rating;
    }

    public function setOriginalRating(float $original_rating): void
    {
        $this->original_rating = $original_rating;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}