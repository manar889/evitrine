<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lib;

    /**
     * @ORM\Column(type="string", length=2500)
     */
    private $Dscr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Img;

    /**
     * @ORM\Column(type="float")
     */
    private $Pu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLib(): ?string
    {
        return $this->Lib;
    }

    public function setLib(string $Lib): self
    {
        $this->Lib = $Lib;

        return $this;
    }

    public function getDscr(): ?string
    {
        return $this->Dscr;
    }

    public function setDscr(string $Dscr): self
    {
        $this->Dscr = $Dscr;

        return $this;
    }

    public function getImg()
    {
        return $this->Img;
    }

    public function setImg($Img)
    {
        $this->Img = $Img;

        return $this;
    }

    public function getPu(): ?float
    {
        return $this->Pu;
    }

    public function setPu(float $Pu): self
    {
        $this->Pu = $Pu;

        return $this;
    }
}
