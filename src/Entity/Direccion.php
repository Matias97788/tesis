<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Direccion
 *
 * @ORM\Table(name="direccion", indexes={@ORM\Index(name="id_ciudad", columns={"id_ciudad"})})
 * @ORM\Entity
 */
class Direccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=50, nullable=false)
     */
    private $calle;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var \Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciudad", referencedColumnName="id")
     * })
     */
    private $idCiudad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getIdCiudad(): ?Ciudad
    {
        return $this->idCiudad;
    }

    public function setIdCiudad(?Ciudad $idCiudad): self
    {
        $this->idCiudad = $idCiudad;

        return $this;
    }
    public function __toString(){
        return $this->getCalle();
    }

}
