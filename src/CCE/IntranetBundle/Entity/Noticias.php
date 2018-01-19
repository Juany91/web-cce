<?php

namespace CCE\IntranetBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;

/**
 * Noticias
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Noticias
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    
    /**
     * @var string
     *
     * @ORM\Column(name="fuente", type="string", length=255)
     */
    private $fuente;

    /**
     * @var string
     *
     * @ORM\Column(name="dirfuente", type="string", length=255)
     */
    private $dirfuente;


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
     * Set titulo
     *
     * @param string $titulo
     * @return Noticias
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     * @return Noticias
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Noticias
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

    /**
     * Set image
     *
     * @param string $image
     * @return Noticias
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set fuente
     *
     * @param string $image
     * @return Noticias
     */
    public function setFuente($fuente)
    {
        $this->fuente = $fuente;

        return $this;
    }

    /**
     * Get fuente
     *
     * @return string
     */
    public function getFuente()
    {
        return $this->fuente;
    }


    /**
     * Set dirfuente
     *
     * @param string $image
     * @return Noticias
     */
    public function setDirFuente($dirfuente)
    {
        $this->dirfuente = $dirfuente;

        return $this;
    }

    /**
     * Get dirfuente
     *
     * @return string
     */
    public function getDirFuente()
    {
        return $this->dirfuente;
    }
}
