<?php

namespace App\Entity;

use App\Repository\CandidaturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidaturesRepository::class)
 */
class Candidatures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Offres::class, inversedBy="candidatures")
     */
    private $offres;

    /**
     * @ORM\ManyToMany(targetEntity=Apprentis::class, mappedBy="candidatures")
     */
    private $apprentis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lettredemotiv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $traite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vu;

    /**
     * @ORM\OneToOne(targetEntity=Reponse::class, inversedBy="candidatures", cascade={"persist", "remove"})
     */
    private $reponse;

    public function __construct()
    {
        $this->apprentis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOffres(): ?Offres
    {
        return $this->offres;
    }

    public function setOffres(?Offres $offres): self
    {
        $this->offres = $offres;

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
            $apprenti->addCandidature($this);
        }

        return $this;
    }

    public function removeApprenti(Apprentis $apprenti): self
    {
        if ($this->apprentis->contains($apprenti)) {
            $this->apprentis->removeElement($apprenti);
            $apprenti->removeCandidature($this);
        }

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getLettredemotiv(): ?string
    {
        return $this->lettredemotiv;
    }

    public function setLettredemotiv(?string $lettredemotiv): self
    {
        $this->lettredemotiv = $lettredemotiv;

        return $this;
    }

    public function getTraite(): ?string
    {
        return $this->traite;
    }

    public function setTraite(?string $traite): self
    {
        $this->traite = $traite;

        return $this;
    }

    public function getVu(): ?string
    {
        return $this->vu;
    }

    public function setVu(?string $vu): self
    {
        $this->vu = $vu;

        return $this;
    }

    public function getReponse(): ?Reponse
    {
        return $this->reponse;
    }

    public function setReponse(?Reponse $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }
}
