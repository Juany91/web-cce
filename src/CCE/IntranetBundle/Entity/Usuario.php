<?php

namespace CCE\IntranetBundle\Entity;

use Assetic\Exception\Exception;
use Doctrine\DBAL\Types\BooleanType;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="carnet", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=11,max=11)
     * 
     */
    private $carnet;

    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Permite cambiar el enabled de los usuarios.
     * @return $this
     * @throws Exception
     * @param  $enabled
     */
    public function setEnabled($enabled)
    {
        if($enabled == 1){
            $this->enabled = true;
        }
        else if($enabled == 2){
            $this->enabled = false;
        }
//        $this->enabled = $enabled;
        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Agrega un rol al usuario.
     * @throws Exception
     * @param Rol $rol
     */
    public function addRole( $rol )
    {
        if($rol == 1) {
            array_push($this->roles, 'ROLE_ADMIN');
        }
        else if($rol == 2) {
            array_push($this->roles, 'ROLE_DIRECTOR');
        }
        else if($rol == 3) {
            array_push($this->roles, 'ROLE_ERRHH');
        }
        else if($rol == 4) {
            array_push($this->roles, 'ROLE_ESPECIALISTA');
        }
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set carnet
     *
     * @param string $carnet
     * @return Usuario
     */
    public function setCarnet($carnet)
    {
        $this->carnet = $carnet;

        return $this;
    }

    /**
     * Get carnet
     *
     * @return string 
     */
    public function getCarnet()
    {
        return $this->carnet;
    }
    public function nombre_completo()
    {
        return $this->nombre.' '.$this->apellidos;
    }

    public function __toString()
    {
        return $this->carnet;
    }

    


}
