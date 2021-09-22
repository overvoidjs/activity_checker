<?php

namespace App\Entity;

use App\Repository\ActivityLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityLogRepository::class)
 */
class ActivityLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="integer")
     */
    private $hits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getHits(): ?int
    {
        return $this->hits;
    }

    public function setHits(int $hits): self
    {
        $this->hits = $hits;

        return $this;
    }

    public function getLastDate(): ?string
    {
        return $this->last_date;
    }

    public function setLastDate(string $last_date): self
    {
        $this->last_date = $last_date;

        return $this;
    }
}
