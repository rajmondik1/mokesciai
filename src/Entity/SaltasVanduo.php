<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SaltasVanduoRepository")
 */
class SaltasVanduo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userid;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $iki;

    /**
     * @ORM\Column(type="integer")
     */
    private $nuo;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifas;

    public function getId()
    {
        return $this->id;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIki(): ?int
    {
        return $this->iki;
    }

    public function setIki(int $iki): self
    {
        $this->iki = $iki;

        return $this;
    }

    public function getNuo(): ?int
    {
        return $this->nuo;
    }

    public function setNuo(int $nuo): self
    {
        $this->nuo = $nuo;

        return $this;
    }

    public function getTarifas(): ?float
    {
        return $this->tarifas;
    }

    public function setTarifas(float $tarifas): self
    {
        $this->tarifas = $tarifas;

        return $this;
    }
}
