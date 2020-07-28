<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rdv;

    /**
     * @ORM\OneToOne(targetEntity=Candidatures::class, mappedBy="reponse", cascade={"persist", "remove"})
     */
    private $candidatures;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $checked;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getRdv(): ?\DateTimeInterface
    {
        return $this->rdv;
    }

    public function setRdv(?\DateTimeInterface $rdv): self
    {
        $this->rdv = $rdv;

        return $this;
    }

    public function getCandidatures(): ?Candidatures
    {
        return $this->candidatures;
    }

    public function setCandidatures(?Candidatures $candidatures): self
    {
        $this->candidatures = $candidatures;

        // set (or unset) the owning side of the relation if necessary
        $newReponse = null === $candidatures ? null : $this;
        if ($candidatures->getReponse() !== $newReponse) {
            $candidatures->setReponse($newReponse);
        }

        return $this;
    }

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(?bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

}
