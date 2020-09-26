<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicio
 *
 * @ORM\Table(name="servicio", indexes={@ORM\Index(name="id_productos", columns={"id_productos"}), @ORM\Index(name="id_proveedor", columns={"id_proveedor"}), @ORM\Index(name="id_direccion", columns={"id_direccion"}), @ORM\Index(name="id_categoria", columns={"id_categoria"}), @ORM\Index(name="id_estado", columns={"id_estado"})})
 * @ORM\Entity
 */
class Servicio
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
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=200, nullable=false)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="horario_atencion", type="string", length=50, nullable=false)
     */
    private $horarioAtencion;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono", type="integer", nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="brochureFilename", type="string", length=200, nullable=false)
     */
    private $brochurefilename;

    /**
     * @var int
     *
     * @ORM\Column(name="id_estado", type="integer", nullable=false)
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

    /**
     * @var \Productos
     *
     * @ORM\ManyToOne(targetEntity="Productos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_productos", referencedColumnName="id")
     * })
     */
    private $idProductos;

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

    public function getHorarioAtencion(): ?string
    {
        return $this->horarioAtencion;
    }

    public function setHorarioAtencion(string $horarioAtencion): self
    {
        $this->horarioAtencion = $horarioAtencion;

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

    public function getBrochurefilename(): ?string
    {
        return $this->brochurefilename;
    }

    public function setBrochurefilename(string $brochurefilename): self
    {
        $this->brochurefilename = $brochurefilename;

        return $this;
    }

    public function getIdEstado(): ?int
    {
        return $this->idEstado;
    }

    public function setIdEstado(int $idEstado): self
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

    public function getIdProductos(): ?Productos
    {
        return $this->idProductos;
    }

    public function setIdProductos(?Productos $idProductos): self
    {
        $this->idProductos = $idProductos;

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

    public function getIdProveedor(): ?Proveedor
    {
        return $this->idProveedor;
    }

    public function setIdProveedor(?Proveedor $idProveedor): self
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }

    public function __toString(){
        return $this->getNombre();
    }
}
