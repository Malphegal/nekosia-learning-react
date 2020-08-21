<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SubscribeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SubscribeRepository::class)
 */
class Subscribe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="subscribes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_account;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="subscribes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_course;

    /**
     * @ORM\Column(type="datetime")
     */
    private $subscribe_date;

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

    public function getSubscribeDate(): ?\DateTimeInterface
    {
        return $this->subscribe_date;
    }

    public function setSubscribeDate(\DateTimeInterface $subscribe_date): self
    {
        $this->subscribe_date = $subscribe_date;

        return $this;
    }
}
