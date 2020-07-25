<?php

namespace App\Entity;

use App\Repository\DomaineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomaineRepository::class)
 */
class Domaine
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
     * @ORM\OneToMany(targetEntity=Offres::class, mappedBy="domaine")
     */
    private $offres;

    /**
     * @ORM\OneToMany(targetEntity=Entreprises::class, mappedBy="domaine")
     */
    private $entreprises;

    public function __construct()
    {

        $this->offres = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
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
            $offre->setDomaine($this);
        }

        return $this;
    }

    public function removeOffre(Offres $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getDomaine() === $this) {
                $offre->setDomaine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entreprises[]
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprises $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->setDomaine($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprises $entreprise): self
    {
        if ($this->entreprises->contains($entreprise)) {
            $this->entreprises->removeElement($entreprise);
            // set the owning side to null (unless already changed)
            if ($entreprise->getDomaine() === $this) {
                $entreprise->setDomaine(null);
            }
        }

        return $this;
    }
}
