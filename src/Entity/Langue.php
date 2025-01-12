<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 5)]
    private ?string $code = null;

    #[ORM\Column]
    private ?bool $estActive = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function isEstActive(): ?bool
    {
        return $this->estActive;
    }

    public function setEstActive(bool $estActive): static
    {
        $this->estActive = $estActive;

        return $this;
    }
}
