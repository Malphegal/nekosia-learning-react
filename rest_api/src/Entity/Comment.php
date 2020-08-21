<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_account;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_course;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

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
