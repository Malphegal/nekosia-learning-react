<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Tag::class, mappedBy="id_skill", orphanRemoval=true)
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Studied::class, mappedBy="id_skill", orphanRemoval=true)
     */
    private $studieds;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->studieds = new ArrayCollection();
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

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->setIdSkill($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            // set the owning side to null (unless already changed)
            if ($tag->getIdSkill() === $this) {
                $tag->setIdSkill(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Studied[]
     */
    public function getStudieds(): Collection
    {
        return $this->studieds;
    }

    public function addStudied(Studied $studied): self
    {
        if (!$this->studieds->contains($studied)) {
            $this->studieds[] = $studied;
            $studied->setIdSkill($this);
        }

        return $this;
    }

    public function removeStudied(Studied $studied): self
    {
        if ($this->studieds->contains($studied)) {
            $this->studieds->removeElement($studied);
            // set the owning side to null (unless already changed)
            if ($studied->getIdSkill() === $this) {
                $studied->setIdSkill(null);
            }
        }

        return $this;
    }
}
