<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FileVersionRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileVersionRepository::class)
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"file_id", "date"})})
 */
class FileVersion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=File::class, inversedBy="fileVersions")
     * @ORM\JoinColumn(nullable=false, name="file_id")
     */
    private File $fileId;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $status;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileId(): ?File
    {
        return $this->fileId;
    }

    public function setFileId(?File $fileId): self
    {
        $this->fileId = $fileId;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
