<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewsRepository;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     attributes={
 *          "order"={"publishedAt":"DESC"}
 *     },
 *     normalizationContext={"groups"="read:news"},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 */
class News
{

    public function __toString() {
        return $this->titre;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read:news")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read:news")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Groups("read:news")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups("read:news")
     */
    private $publishedAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }
}
