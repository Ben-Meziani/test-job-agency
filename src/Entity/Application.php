<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 */
class Application
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
    private $motivationLetter;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="applications")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="applications")
     */
    private $mission;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotivationLetter(): ?string
    {
        return $this->motivationLetter;
    }

    public function setMotivationLetter(string $motivationLetter): self
    {
        $this->motivationLetter = $motivationLetter;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }
}
