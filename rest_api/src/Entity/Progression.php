<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProgressionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ProgressionRepository::class)
 */
class Progression
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="progressions")
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_account;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="progressions")
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_course;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $page_number;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPageNumber(): ?int
    {
        return $this->page_number;
    }

    public function setPageNumber(int $page_number): self
    {
        $this->page_number = $page_number;

        return $this;
    }
}
