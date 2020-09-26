<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Obituario
 *
 * @ORM\Table(name="obituario", indexes={@ORM\Index(name="id_admin", columns={"id_admin"}), @ORM\Index(name="Id_direccion", columns={"Id_direccion"})})
 * @ORM\Entity
 */
class Obituario
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_nacimiento", type="string", length=15, nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_muerte", type="string", length=15, nullable=false)
     */
    private $fechaMuerte;

    /**
     * @var \Direccion
     *
     * @ORM\ManyToOne(targetEntity="Direccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_direccion", referencedColumnName="id")
     * })
     */
    private $idDireccion;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaNacimiento(): ?string
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(string $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getFechaMuerte(): ?string
    {
        return $this->fechaMuerte;
    }

    public function setFechaMuerte(string $fechaMuerte): self
    {
        $this->fechaMuerte = $fechaMuerte;

        return $this;
    }

    public function getIdDireccion(): ?Direccion
    {
        return $this->idDireccion;
    }

    public function setIdDireccion(?Direccion $idDireccion): self
    {
        $this->idDireccion = $idDireccion;

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
