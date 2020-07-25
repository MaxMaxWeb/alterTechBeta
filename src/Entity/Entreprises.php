<?php

namespace App\Entity;

use App\Repository\EntreprisesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Entity(repositoryClass=EntreprisesRepository::class)
 */
class Entreprises
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=Offres::class, mappedBy="entreprises")
     */
    private $offres;


    /**
     * @ORM\OneToMany(targetEntity=Tests::class, mappedBy="entreprises")
     */
    private $tests;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $verified;


    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="ficheEntreprise")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class, inversedBy="entreprises")
     */
    private $domaine;



    public function __construct()
    {
        $this->offres = new ArrayCollection();

        $this->tests = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $offre->setEntreprises($this);
        }

        return $this;
    }

    public function removeOffre(Offres $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getEntreprises() === $this) {
                $offre->setEntreprises(null);
            }
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
            $test->setEntreprises($this);
        }

        return $this;
    }

    public function removeTest(Tests $test): self
    {
        if ($this->tests->contains($test)) {
            $this->tests->removeElement($test);
            // set the owning side to null (unless already changed)
            if ($test->getEntreprises() === $this) {
                $test->setEntreprises(null);
            }
        }

        return $this;
    }

    public function getVerified(): ?string
    {
        return $this->verified;
    }

    public function setVerified(string $verified): self
    {
        $this->verified = $verified;

        return $this;
    }



    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setFicheEntreprise($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getFicheEntreprise() === $this) {
                $user->setFicheEntreprise(null);
            }
        }

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
