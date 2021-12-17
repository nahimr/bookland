<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Isbn(type="isbn13", isbn13Message="Ce n'est pas un ISBN-13")
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(value=0, message="Le livre doit avoir au moins une page")
     */
    private $nbpages;

    /**
     * @ORM\Column(type="date")
     * @Assert\LessThan(value="tomorrow", message="La date doit être antérieur à demain")
     */
    private $date_de_parution;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\Range(min=0, max=20,
     *     notInRangeMessage="La note doit être entre {{ min }} et {{ max }}")
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, mappedBy="livres", cascade={"persist"})
     */
    private $auteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="livres")
     */
    private $genres;

    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbpages(): ?int
    {
        return $this->nbpages;
    }

    public function setNbpages(int $nbpages): self
    {
        $this->nbpages = $nbpages;

        return $this;
    }

    public function getDateDeParution(): ?\DateTimeInterface
    {
        return $this->date_de_parution;
    }

    public function setDateDeParution(\DateTimeInterface $date_de_parution): self
    {
        $this->date_de_parution = $date_de_parution;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs[] = $auteur;
            $auteur->addLivre($this);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        if ($this->auteurs->removeElement($auteur)) {
            $auteur->removeLivre($this);
        }

        return $this;
    }

    /**
     * @param ArrayCollection $auteurs
     */
    public function setAuteurs(ArrayCollection $auteurs): void
    {
        $this->auteurs = $auteurs;
    }

    /**
     * @param ArrayCollection $genres
     */
    public function setGenres(ArrayCollection $genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function __toString()
    {
        return $this->titre;
    }


}
