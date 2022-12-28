<?php

namespace App\Entity;

use App\Repository\PlanTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanTemplateRepository::class)]
class PlanTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'template', targetEntity: Plan::class, orphanRemoval: true)]
    private Collection $instantiations;

    public function __construct()
    {
        $this->instantiations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    /**
     * @return Collection<int, Plan>
     */
    public function getInstantiations(): Collection
    {
        return $this->instantiations;
    }

    public function addInstantiation(Plan $instantiation): self
    {
        if (!$this->instantiations->contains($instantiation)) {
            $this->instantiations->add($instantiation);
            $instantiation->setTemplate($this);
        }

        return $this;
    }

    public function removeInstantiation(Plan $instantiation): self
    {
        if ($this->instantiations->removeElement($instantiation)) {
            // set the owning side to null (unless already changed)
            if ($instantiation->getTemplate() === $this) {
                $instantiation->setTemplate(null);
            }
        }

        return $this;
    }
}
