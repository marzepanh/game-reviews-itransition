<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $reviewGroup;

    #[ORM\Column(type: 'array')]
    private $tags = [];

    #[ORM\Column(type: 'text')]
    private $text;

    #[ORM\Column(type: 'string', length: 255)]
    private $images;

    #[ORM\Column(type: 'decimal', precision: 2, scale: 1)]
    private $authorGrade;

    #[ORM\Column(type: 'decimal', precision: 2, scale: 1)]
    private $usersGrade;

    #[ORM\Column(type: 'integer')]
    private $likesAmount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReviewGroup(): ?string
    {
        return $this->reviewGroup;
    }

    public function setReviewGroup(string $reviewGroup): self
    {
        $this->reviewGroup = $reviewGroup;

        return $this;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getAuthorGrade(): ?string
    {
        return $this->authorGrade;
    }

    public function setAuthorGrade(string $authorGrade): self
    {
        $this->authorGrade = $authorGrade;

        return $this;
    }

    public function getUsersGrade(): ?string
    {
        return $this->usersGrade;
    }

    public function setUsersGrade(string $usersGrade): self
    {
        $this->usersGrade = $usersGrade;

        return $this;
    }

    public function getLikesAmount(): ?int
    {
        return $this->likesAmount;
    }

    public function setLikesAmount(int $likesAmount): self
    {
        $this->likesAmount = $likesAmount;

        return $this;
    }
}
