<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManufacturerRepository")
 */
class Manufacturer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Model", mappedBy="manufacturer", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $model;

    public function __construct()
    {
        $this->model = new ArrayCollection();
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

    /**
     * @return Collection|Model[]
     */
    public function getModel(): Collection
    {
        return $this->model;
    }

    public function addModel(Model $model): self
    {
        if (!$this->model->contains($model)) {
            $this->model[] = $model;
            $model->setManufacturer($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->model->contains($model)) {
            $this->model->removeElement($model);
            // set the owning side to null (unless already changed)
            if ($model->getManufacturer() === $this) {
                $model->setManufacturer(null);
            }
        }

        return $this;
    }
}
