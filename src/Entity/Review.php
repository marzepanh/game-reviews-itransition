<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'text')]
    private $text;

    #[ORM\Column(type: 'string', length: 255)]
    private $images;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'decimal', precision: 2, scale: 1)]
    private $authorGrade;

    #[ORM\Column(type: 'decimal', precision: 2, scale: 1)]
    private $usersGrade;

    #[ORM\Column(type: 'integer')]
    private $likesAmount;

    #[ORM\Column(type: 'string', length: 255)]
    private $cover;

    #[ORM\Column(type: 'string', length: 255)]
    private $author;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'boolean')]
    private $isDeleted;

    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'reviews')]
    private $reviewTags;

    public function __construct()
    {
        $this->reviewTags = new ArrayCollection();
    }

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

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getReviewTags(): Collection
    {
        return $this->reviewTags;
    }

    public function addReviewTag(Tags $reviewTag): self
    {
        if (!$this->reviewTags->contains($reviewTag)) {
            $this->reviewTags[] = $reviewTag;
        }

        return $this;
    }

    public function removeReviewTag(Tags $reviewTag): self
    {
        $this->reviewTags->removeElement($reviewTag);

        return $this;
    }

}
