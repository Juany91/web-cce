<?php

namespace CCE\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Ueb
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ueb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;



    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_foto", type="string", length=255)
     */
    private $rutaFoto;

    /**
     * @Assert\Image(maxSize = "2048k")
     */
    protected $foto;

    /*
     * @ORM\OnetoMany(targetEntity="Producto", mappedBy="idueb")
     */
    protected $productos;

    /**
     * @return ArrayCollection|Producto[]
     */
    public function getProductos()
    {
        return $this->productos;
    }

    public function addProduto(Producto $request)
    {
        $this->productos->add($request);
        return $this;
    }

    public function removeProducto(Producto $request)
    {
        $this->productos->removeElement($request);
        return $this;
    }

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    /**
     * @param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto = null)
    {
        $this->foto = $foto;
    }
    /**
     * @return UploadedFile
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set rutaFoto
     *
     * @param string $rutaFoto
     * @return Galeria
     */
    public function setRutaFoto($rutaFoto)
    {
        $this->rutaFoto = $rutaFoto;

        return $this;
    }

    /**
     * Get rutaFoto
     *
     * @return string
     */
    public function getRutaFoto()
    {
        return $this->rutaFoto;
    }


    public function subirFoto()
    {
        if (null === $this->foto) {
            return;
        }
        $directorioDestino = __DIR__.'/../../../../web/uploads/images';
        $nombreArchivoFoto = $this->foto->getClientOriginalName();
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutaFoto($nombreArchivoFoto);
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
     * @return Ueb
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Ueb
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Ueb
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
