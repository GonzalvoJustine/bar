<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    // On ne peut pas modifier une constante et elles sont liées à la classe et pas à l'objet
    const SPECIAL = "special";
    const NORMAL = "normal";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $term;

    /**
     * @ORM\ManyToMany(targetEntity=Beer::class, mappedBy="categories")
     */
    private $beers;

    public function __construct()
    {
        $this->setTerm(self::NORMAL);
        $this->beers = new ArrayCollection();
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

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(?string $term): self
    {
        // Sécurité des termes
        if(!in_array($term, [self::NORMAL, self::SPECIAL])) {
            // On lance une exception ce qui provoque l'arrêt des scripts

            // throw new \Exception(); // Trop vague, il faut être plus précis dans nos exceptions
            throw new \InvalidArgumentException('Invalid term');
        }

        $this->term = $term;

        return $this;
    }

    /**
     * @return Collection|Beer[]
     */
    public function getBeers(): Collection
    {
        return $this->beers;
    }

    public function addBeer(Beer $beer): self
    {
        if (!$this->beers->contains($beer)) {
            $this->beers[] = $beer;
            $beer->addCategory($this);
        }

        return $this;
    }

    public function removeBeer(Beer $beer): self
    {
        if ($this->beers->removeElement($beer)) {
            $beer->removeCategory($this);
        }

        return $this;
    }

}
