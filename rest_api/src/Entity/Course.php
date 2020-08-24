<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $created_date;

    /**
     * @ORM\Column(type="date")
     */
    private $edited_date;

    /**
     * @ORM\Column(type="smallint")
     */
    private $difficulty;

    /**
     * @ORM\ManyToOne(targetEntity=Theme::class, inversedBy="courses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="courses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $account;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="course")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="course")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Subscribe::class, mappedBy="course", orphanRemoval=true)
     */
    private $subscribes;

    /**
     * @ORM\OneToMany(targetEntity=Tag::class, mappedBy="course", orphanRemoval=true)
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Progression::class, mappedBy="course", orphanRemoval=true)
     */
    private $progressions;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->subscribes = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->progressions = new ArrayCollection();
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

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }

    public function getEditedDate(): ?\DateTimeInterface
    {
        return $this->edited_date;
    }

    public function setEditedDate(\DateTimeInterface $edited_date): self
    {
        $this->edited_date = $edited_date;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
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
            $comment->setIdCourse($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdCourse() === $this) {
                $comment->setIdCourse(null);
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
            $note->setIdCourse($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getIdCourse() === $this) {
                $note->setIdCourse(null);
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
            $subscribe->setIdCourse($this);
        }

        return $this;
    }

    public function removeSubscribe(Subscribe $subscribe): self
    {
        if ($this->subscribes->contains($subscribe)) {
            $this->subscribes->removeElement($subscribe);
            // set the owning side to null (unless already changed)
            if ($subscribe->getIdCourse() === $this) {
                $subscribe->setIdCourse(null);
            }
        }

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
            $tag->setIdCourse($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            // set the owning side to null (unless already changed)
            if ($tag->getIdCourse() === $this) {
                $tag->setIdCourse(null);
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
            $progression->setIdCourse($this);
        }

        return $this;
    }

    public function removeProgression(Progression $progression): self
    {
        if ($this->progressions->contains($progression)) {
            $this->progressions->removeElement($progression);
            // set the owning side to null (unless already changed)
            if ($progression->getIdCourse() === $this) {
                $progression->setIdCourse(null);
            }
        }

        return $this;
    }
}
