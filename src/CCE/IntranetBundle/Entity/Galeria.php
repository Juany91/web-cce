<?php

namespace CCE\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Galeria
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Galeria
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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

}
