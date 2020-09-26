<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Otros
 *
 * @ORM\Table(name="otros", indexes={@ORM\Index(name="otros_ibfk_1", columns={"id_admin"})})
 * @ORM\Entity
 */
class Otros
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
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=200, nullable=false)
     */
    private $correo;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono", type="integer", nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=200, nullable=false)
     */
    private $descripcion;

    /**
     * @var \Admin
     *
     * @ORM\ManyToOne(targetEntity="Admin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_admin", referencedColumnName="id")
     * })
     */
    private $idAdmin;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
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

    public function getIdAdmin(): ?Admin
    {
        return $this->idAdmin;
    }

    public function setIdAdmin(?Admin $idAdmin): self
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }
    public function __toString(){
        return $this->getNombre();
    }

}
