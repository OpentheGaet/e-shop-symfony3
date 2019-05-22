<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\itemRepository")
 * @Vich\Uploadable
 */
class item
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="os", type="string", length=50)
     */
    private $os;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=50)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="screen_size", type="integer")
     */
    private $screenSize;

    /**
     * @var int
     *
     * @ORM\Column(name="processor", type="integer")
     */
    private $processor;

    /**
     * @var int
     *
     * @ORM\Column(name="RAM", type="integer")
     */
    private $rAM;

    /**
     * @var int
     *
     * @ORM\Column(name="ROM", type="integer")
     */
    private $rOM;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="promos", type="integer", nullable=True)
     */
    private $promos;

    /**
     * @Vich\UploadableField(mapping="item_image", fileNameProperty="imageName")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="categorie")
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return string
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this->brand;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this->title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set os
     *
     * @param string $os
     *
     * @return item
     */
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return string
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set screenSize
     *
     * @param integer $screenSize
     *
     * @return item
     */
    public function setScreenSize($screenSize)
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    /**
     * Get screenSize
     *
     * @return int
     */
    public function getScreenSize()
    {
        return $this->screenSize;
    }

    /**
     * Set processor
     *
     * @param integer $processor
     *
     * @return item
     */
    public function setProcessor($processor)
    {
        $this->processor = $processor;

        return $this;
    }

    /**
     * Get processor
     *
     * @return int
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * Set rAM
     *
     * @param integer $rAM
     *
     * @return item
     */
    public function setRAM($rAM)
    {
        $this->rAM = $rAM;

        return $this;
    }

    /**
     * Get rAM
     *
     * @return int
     */
    public function getRAM()
    {
        return $this->rAM;
    }

    /**
     * Set rOM
     *
     * @param integer $rOM
     *
     * @return item
     */
    public function setROM($rOM)
    {
        $this->rOM = $rOM;

        return $this;
    }

    /**
     * Get rOM
     *
     * @return int
     */
    public function getROM()
    {
        return $this->rOM;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return item
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set promos
     *
     * @param integer $promos
     *
     * @return item
     */
    public function setPromos($promos)
    {
        $this->promos = $promos;

        return $this;
    }

    /**
     * Get promos
     *
     * @return int
     */
    public function getPromos()
    {
        return $this->promos;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return item
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return item
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

}

