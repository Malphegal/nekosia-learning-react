<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StudiedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StudiedRepository::class)
 */
class Studied
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="studieds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_account;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="studieds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_skill;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

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

    public function getIdSkill(): ?Skill
    {
        return $this->id_skill;
    }

    public function setIdSkill(?Skill $id_skill): self
    {
        $this->id_skill = $id_skill;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
