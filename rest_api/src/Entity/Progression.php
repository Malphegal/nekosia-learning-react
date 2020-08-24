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
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="progressions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="progressions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $course;

    /**
     * @ORM\Column(type="integer")
     */
    private $page_number;

    /**
     * @ORM\Column(type="date")
     */
    private $progression_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

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

    public function getProgressionDate(): ?\DateTimeInterface
    {
        return $this->progression_date;
    }

    public function setProgressionDate(\DateTimeInterface $progression_date): self
    {
        $this->progression_date = $progression_date;

        return $this;
    }
}
