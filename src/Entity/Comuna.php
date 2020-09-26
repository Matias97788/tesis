<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comuna
 *
 * @ORM\Table(name="comuna", indexes={@ORM\Index(name="id_provincia", columns={"id_provincia"})})
 * @ORM\Entity
 */
class Comuna
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
     * @var \Provincia
     *
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_provincia", referencedColumnName="id")
     * })
     */
    private $idProvincia;

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

    public function getIdProvincia(): ?Provincia
    {
        return $this->idProvincia;
    }

    public function setIdProvincia(?Provincia $idProvincia): self
    {
        $this->idProvincia = $idProvincia;

        return $this;
    }

    public function __toString(){
        return $this->getDescripcion();
    }
}
