<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_account;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_course;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIdAccount(): ?Account
    {
        return $this->id_account;
    }

    public function setIdAccount(?Account $id_account): self
    {
        $this->id_account = $id_account;

        return $this;
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
}
