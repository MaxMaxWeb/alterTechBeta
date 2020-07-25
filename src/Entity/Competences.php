<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 */
class Competences
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
     * @ORM\ManyToMany(targetEntity=Tests::class, mappedBy="competences")
     */
    private $tests;

    /**
     * @ORM\ManyToMany(targetEntity=Offres::class, mappedBy="competences")
     */
    private $offres;

    /**
     * @ORM\ManyToMany(targetEntity=Apprentis::class, mappedBy="competences")
     */
    private $apprentis;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
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
     * @return Collection|Tests[]
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Tests $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->addCompetence($this);
        }

        return $this;
    }

    public function removeTest(Tests $test): self
    {
        if ($this->tests->contains($test)) {
            $this->tests->removeElement($test);
            $test->removeCompetence($this);
        }

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
            $offre->addCompetence($this);
        }

        return $this;
    }

    public function removeOffre(Offres $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            $offre->removeCompetence($this);
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
            $apprenti->addCompetence($this);
        }

        return $this;
    }

    public function removeApprenti(Apprentis $apprenti): self
    {
        if ($this->apprentis->contains($apprenti)) {
            $this->apprentis->removeElement($apprenti);
            $apprenti->removeCompetence($this);
        }

        return $this;
    }
}
