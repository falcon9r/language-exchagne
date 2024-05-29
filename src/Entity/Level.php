<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, LanguageLevel>
     */
    #[ORM\OneToMany(targetEntity: LanguageLevel::class, mappedBy: 'level')]
    private Collection $languageLevels;

    public function __construct()
    {
        $this->languageLevels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, LanguageLevel>
     */
    public function getLanguageLevels(): Collection
    {
        return $this->languageLevels;
    }

    public function addLanguageLevel(LanguageLevel $languageLevel): static
    {
        if (!$this->languageLevels->contains($languageLevel)) {
            $this->languageLevels->add($languageLevel);
            $languageLevel->setLevel($this);
        }

        return $this;
    }

    public function removeLanguageLevel(LanguageLevel $languageLevel): static
    {
        if ($this->languageLevels->removeElement($languageLevel)) {
            // set the owning side to null (unless already changed)
            if ($languageLevel->getLevel() === $this) {
                $languageLevel->setLevel(null);
            }
        }

        return $this;
    }
}
