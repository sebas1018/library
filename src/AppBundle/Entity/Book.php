<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 */
class Book
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="autor", type="string", length=255)
     */
    private $autor;

    /**
     * @var int
     *
     * @ORM\Column(name="minAge", type="integer")
     */
    private $minAge;

    /**
     * @var int
     *
     * @ORM\Column(name="maxAge", type="integer")
     */
    private $maxAge;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="books")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="delivery", mappedBy="book")
     */
    protected $deliveries;

    /**
    * Construct Method
    */
    public function __construct()
    {
       $this->deliveries = new ArrayCollection();
    }

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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Book
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
     * Set autor
     *
     * @param string $autor
     *
     * @return Book
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set minAge
     *
     * @param integer $minAge
     *
     * @return Book
     */
    public function setMinAge($minAge)
    {
        $this->minAge = $minAge;

        return $this;
    }

    /**
     * Get minAge
     *
     * @return int
     */
    public function getMinAge()
    {
        return $this->minAge;
    }

    /**
     * Set maxAge
     *
     * @param integer $maxAge
     *
     * @return Book
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = $maxAge;

        return $this;
    }

    /**
     * Get maxAge
     *
     * @return int
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Book
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add delivery
     *
     * @param \AppBundle\Entity\delivery $delivery
     *
     * @return Book
     */
    public function addDelivery(\AppBundle\Entity\delivery $delivery)
    {
        $this->deliveries[] = $delivery;

        return $this;
    }

    /**
     * Remove delivery
     *
     * @param \AppBundle\Entity\delivery $delivery
     */
    public function removeDelivery(\AppBundle\Entity\delivery $delivery)
    {
        $this->deliveries->removeElement($delivery);
    }

    /**
     * Get deliveries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliveries()
    {
        return $this->deliveries;
    }
}
