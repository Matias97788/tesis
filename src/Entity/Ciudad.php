<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciudad
 *
 * @ORM\Table(name="ciudad", indexes={@ORM\Index(name="id_comuna", columns={"id_comuna"})})
 * @ORM\Entity
 */
class Ciudad
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
     * @ORM\Column(name="descripcion", type="string", length=50, nullable=false)
     */
    private $descripcion;

    /**
     * @var \Comuna
     *
     * @ORM\ManyToOne(targetEntity="Comuna")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIdComuna(): ?Comuna
    {
        return $this->idComuna;
    }

    public function setIdComuna(?Comuna $idComuna): self
    {
        $this->idComuna = $idComuna;

        return $this;
    }

    public function __toString(){
        return $this->getDescripcion();
    }
}
