<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Course::class, mappedBy="id_account")
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="id_account")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="id_account")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Subscribe::class, mappedBy="id_account", orphanRemoval=true)
     */
    private $subscribes;

    /**
     * @ORM\OneToMany(targetEntity=Progression::class, mappedBy="id_account", orphanRemoval=true)
     */
    private $progressions;

    /**
     * @ORM\Column(type="date")
     */
    private $created_date;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->subscribes = new ArrayCollection();
        $this->progressions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Course[]
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->setIdAccount($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->courses->contains($course)) {
            $this->courses->removeElement($course);
            // set the owning side to null (unless already changed)
            if ($course->getIdAccount() === $this) {
                $course->setIdAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdAccount($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdAccount() === $this) {
                $comment->setIdAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setIdAccount($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getIdAccount() === $this) {
                $note->setIdAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Subscribe[]
     */
    public function getSubscribes(): Collection
    {
        return $this->subscribes;
    }

    public function addSubscribe(Subscribe $subscribe): self
    {
        if (!$this->subscribes->contains($subscribe)) {
            $this->subscribes[] = $subscribe;
            $subscribe->setIdAccount($this);
        }

        return $this;
    }

    public function removeSubscribe(Subscribe $subscribe): self
    {
        if ($this->subscribes->contains($subscribe)) {
            $this->subscribes->removeElement($subscribe);
            // set the owning side to null (unless already changed)
            if ($subscribe->getIdAccount() === $this) {
                $subscribe->setIdAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Progression[]
     */
    public function getProgressions(): Collection
    {
        return $this->progressions;
    }

    public function addProgression(Progression $progression): self
    {
        if (!$this->progressions->contains($progression)) {
            $this->progressions[] = $progression;
            $progression->setIdAccount($this);
        }

        return $this;
    }

    public function removeProgression(Progression $progression): self
    {
        if ($this->progressions->contains($progression)) {
            $this->progressions->removeElement($progression);
            // set the owning side to null (unless already changed)
            if ($progression->getIdAccount() === $this) {
                $progression->setIdAccount(null);
            }
        }

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
}
