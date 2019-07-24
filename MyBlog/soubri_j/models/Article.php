<?php
/*
    ETNA PROJECT, 26/11/2018 by soubri_j
    my_blog : Article.php
    File description:
        Article object.
*/
class Article {
    private $id;
    private $title;
    private $creation_date;
    private $short_description;
    private $description;
    private $image_type;
    private $image;

    public function __construct(int $id, string $title, string $creation_date, 
                                string $short_description, string $description,
                                ?string $image_type, ?string $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->creation_date = $creation_date;
        $this->short_description = $short_description;
        $this->description = $description;
        $this->image_type = $image_type;
        $this->image = $image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreationDate(): string
    {
        return $this->creation_date;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImageType(): ?string
    {
        return $this->image_type;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
}
?>