<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private string $directory;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $status;

    /**
     * @ORM\Column(type="integer", options={"default" : null})
     */
    private ?int $FileTag;

    /**
     * @ORM\OneToMany(targetEntity=FileVersion::class, mappedBy="fileId", orphanRemoval=true)
     */
    private Collection $fileVersions;

    public function __construct()
    {
        $this->fileVersions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getFileTag(): ?int
    {
        return $this->FileTag;
    }

    public function setFileTag(?int $FileTag): self
    {
        $this->FileTag = $FileTag;

        return $this;
    }

    /**
     * @return Collection|FileVersion[]
     */
    public function getFileVersions(): Collection
    {
        return $this->fileVersions;
    }

    public function addFileVersion(FileVersion $fileVersion): self
    {
        if (!$this->fileVersions->contains($fileVersion)) {
            $this->fileVersions[] = $fileVersion;
            $fileVersion->setFileId($this);
        }

        return $this;
    }

    public function removeFileVersion(FileVersion $fileVersion): self
    {
        if ($this->fileVersions->removeElement($fileVersion)) {
            // set the owning side to null (unless already changed)
            if ($fileVersion->getFileId() === $this) {
                $fileVersion->setFileId(null);
            }
        }

        return $this;
    }
}
