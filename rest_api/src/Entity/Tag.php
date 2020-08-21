<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="tags")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_course;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="tags")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_skill;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCourse(): ?Course
    {
        return $this->id_course;
    }

    public function setIdCourse(?Course $id_course): self
    {
        $this->id_course = $id_course;

        return $this;
    }

    public function getIdSkill(): ?Skill
    {
        return $this->id_skill;
    }

    public function setIdSkill(?Skill $id_skill): self
    {
        $this->id_skill = $id_skill;

        return $this;
    }
}
