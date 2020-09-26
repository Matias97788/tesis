<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProveedorDireccion
 *
 * @ORM\Table(name="proveedor_direccion", indexes={@ORM\Index(name="id_proveedor", columns={"id_proveedor"}), @ORM\Index(name="id_direccion", columns={"id_direccion"})})
 * @ORM\Entity
 */
class ProveedorDireccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_proveedor_direccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProveedorDireccion;

    /**
     * @var \Direccion
     *
     * @ORM\ManyToOne(targetEntity="Direccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id")
     * })
     */
    private $idDireccion;

    /**
     * @var \Proveedor
     *
     * @ORM\ManyToOne(targetEntity="Proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proveedor", referencedColumnName="run")
     * })
     */
    private $idProveedor;

    public function getIdProveedorDireccion(): ?int
    {
        return $this->idProveedorDireccion;
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

    public function getIdProveedor(): ?Proveedor
    {
        return $this->idProveedor;
    }

    public function setIdProveedor(?Proveedor $idProveedor): self
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }


}
