<?php

namespace CCE\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Producto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Producto
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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ficha", type="string", length=255)
     */
    private $ficha;

    /**
     * @Assert\File(
     *     maxSize = "10024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     */
    protected $pdf;

    /**
     * @var \Ueb
     *
     * @ORM\ManyToOne(targetEntity="Ueb", inversedBy="productos")
     * @ORM\JoinColumn(name="idueb", referencedColumnName="id")
     *
     */
    private $idueb;


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
     * @param UploadedFile $pdf
     */
    public function setPdf(UploadedFile $pdf = null)
    {
        $this->pdf = $pdf;
    }
    /**
     * @return UploadedFile
     */
    public function getPdf()
    {
        return $this->pdf;
    }


    public function subirPdf()
    {
        if (null === $this->pdf) {
            return;
        }
        $directorioDestino = __DIR__.'/../../../../web/uploads/ficha';
        $nombreArchivoPdf = $this->pdf->getClientOriginalName();
        $this->pdf->move($directorioDestino, $nombreArchivoPdf);
        $this->setFicha($nombreArchivoPdf);
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
     * @return Producto
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
     * @return Producto
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
     * Set ficha
     *
     * @param string $ficha
     * @return Producto
     */
    public function setFicha($ficha)
    {
        $this->ficha = $ficha;

        return $this;
    }

    /**
     * Get ficha
     *
     * @return string 
     */
    public function getFicha()
    {
        return $this->ficha;
    }

    /**
     * Set idueb
     *
     * @param string $idueb
     * @return Producto
     */
    public function setIdueb($idueb)
    {
        $this->idueb = $idueb;

        return $this;
    }

    /**
     * Get idueb
     *
     * @return string 
     */
    public function getIdueb()
    {
        return $this->idueb;
    }
}
