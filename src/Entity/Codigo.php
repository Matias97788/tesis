<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Codigo
 *
 * @ORM\Table(name="codigo", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Codigo
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
     * @ORM\Column(name="codigounico", type="string", nullable=false)
     */
    private $codigounico;

    /**
     * @var int
     *
     * @ORM\Column(name="codigorandom", type="integer", nullable=false)
     */
    private $codigorandom;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigounico(): ?string
    {
        return $this->codigounico;
    }

    public function setCodigounico(string $codigounico): self
    {
        $this->codigounico = $codigounico;

        return $this;
    }

    public function getCodigorandom(): ?int
    {
        return $this->codigorandom;
    }

    public function setCodigorandom(int $codigorandom): self
    {
        $this->codigorandom = $codigorandom;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
