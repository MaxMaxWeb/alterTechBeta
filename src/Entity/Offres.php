<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffresRepository::class)
 */
class Offres
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
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $begin_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, inversedBy="offres")
     */
    private $competences;

    /**
     * @ORM\OneToMany(targetEntity=Tests::class, mappedBy="offres")
     */
    private $tests;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_candidats;

    /**
     * @ORM\OneToMany(targetEntity=Candidatures::class, mappedBy="offres")
     */
    private $candidatures;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprises::class, inversedBy="offres")
     */
    private $entreprises;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="offres")
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class, inversedBy="offres")
     */
    private $domaine;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->tests = new ArrayCollection();
        $this->candidatures = new ArrayCollection();
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



    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->begin_at;
    }

    public function setBeginAt(\DateTimeInterface $begin_at): self
    {
        $this->begin_at = $begin_at;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
        }

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
            $test->setOffres($this);
        }

        return $this;
    }

    public function removeTest(Tests $test): self
    {
        if ($this->tests->contains($test)) {
            $this->tests->removeElement($test);
            // set the owning side to null (unless already changed)
            if ($test->getOffres() === $this) {
                $test->setOffres(null);
            }
        }

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(?int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getNbCandidats(): ?int
    {
        return $this->nb_candidats;
    }

    public function setNbCandidats(?int $nb_candidats): self
    {
        $this->nb_candidats = $nb_candidats;

        return $this;
    }

    /**
     * @return Collection|Candidatures[]
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidatures $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures[] = $candidature;
            $candidature->setOffres($this);
        }

        return $this;
    }

    public function removeCandidature(Candidatures $candidature): self
    {
        if ($this->candidatures->contains($candidature)) {
            $this->candidatures->removeElement($candidature);
            // set the owning side to null (unless already changed)
            if ($candidature->getOffres() === $this) {
                $candidature->setOffres(null);
            }
        }

        return $this;
    }

    public function getEntreprises(): ?Entreprises
    {
        return $this->entreprises;
    }

    public function setEntreprises(?Entreprises $entreprises): self
    {
        $this->entreprises = $entreprises;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }
}
