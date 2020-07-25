<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;



    /**
     * @ORM\OneToMany(targetEntity=Offres::class, mappedBy="niveau")
     */
    private $offres;

    /**
     * @ORM\OneToMany(targetEntity=Apprentis::class, mappedBy="niveau")
     */
    private $apprentis;


    public function __construct()
    {

        $this->offres = new ArrayCollection();
        $this->apprentis = new ArrayCollection();
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





    /**
     * @return Collection|Offres[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offres $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setNiveau($this);
        }

        return $this;
    }

    public function removeOffre(Offres $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getNiveau() === $this) {
                $offre->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Apprentis[]
     */
    public function getApprentis(): Collection
    {
        return $this->apprentis;
    }

    public function addApprenti(Apprentis $apprenti): self
    {
        if (!$this->apprentis->contains($apprenti)) {
            $this->apprentis[] = $apprenti;
            $apprenti->setNiveau($this);
        }

        return $this;
    }

    public function removeApprenti(Apprentis $apprenti): self
    {
        if ($this->apprentis->contains($apprenti)) {
            $this->apprentis->removeElement($apprenti);
            // set the owning side to null (unless already changed)
            if ($apprenti->getNiveau() === $this) {
                $apprenti->setNiveau(null);
            }
        }

        return $this;
    }










}
