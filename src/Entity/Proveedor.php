<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedor
 *
 * @ORM\Table(name="proveedor", indexes={@ORM\Index(name="id_categoria", columns={"id_categoria"}), @ORM\Index(name="id_estado", columns={"id_estado"})})
 * @ORM\Entity
 */
class Proveedor
{
    /**
     * @var string
     *
     * @ORM\Column(name="run", type="string", length=12, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $run;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=50, nullable=false)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=200, nullable=false)
     */
    private $clave;

    /**
     * @var int
     *
     * @ORM\Column(name="Telefono", type="integer", nullable=false)
     */
    private $telefono;

    /**
     * @var \Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria", referencedColumnName="id")
     * })
     */
    private $idCategoria;

    public function getRun(): ?string
    {
        return $this->run;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getIdEstado(): ?Estado
    {
        return $this->idEstado;
    }

    public function setIdEstado(?Estado $idEstado): self
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    public function getIdCategoria(): ?Categoria
    {
        return $this->idCategoria;
    }

    public function setIdCategoria(?Categoria $idCategoria): self
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }
    public function __toString(){
    return $this->getNombre();
    }

}
