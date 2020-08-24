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
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="subscribes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $course;

    /**
     * @ORM\Column(type="datetime")
     */
    private $subscribe_date;

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
