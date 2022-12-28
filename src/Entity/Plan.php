<?php

namespace App\Entity;

use App\Repository\PlanRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanRepository::class)]
#[ORM\Table(name: '`plan`')]
class Plan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $raceDate = null;

    #[ORM\ManyToOne(inversedBy: 'instantiations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlanTemplate $template = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaceDate(): ?\DateTimeInterface
    {
        return $this->raceDate;
    }

    public function setRaceDate(\DateTimeInterface $raceDate): self
    {
        $this->raceDate = $raceDate;

        return $this;
    }

    public function getTemplate(): ?PlanTemplate
    {
        return $this->template;
    }

    public function setTemplate(?PlanTemplate $template): self
    {
        $this->template = $template;

        return $this;
    }
}
