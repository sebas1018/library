<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * delivery
 *
 * @ORM\Table(name="delivery")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\deliveryRepository")
 */
class delivery
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_delivery", type="date")
     */
    private $dateDelivery;

    /**
    * @var boolean
    *
    * @ORM\Column(name="isReturned", type="boolean")
    */
    private $isReturned;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="deliveries")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     */
    protected $book;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="deliveries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
     * Set dateDelivery
     *
     * @param \DateTime $dateDelivery
     *
     * @return delivery
     */
    public function setDateDelivery($dateDelivery)
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    /**
     * Get dateDelivery
     *
     * @return \DateTime
     */
    public function getDateDelivery()
    {
        return $this->dateDelivery;
    }

    /**
     * Set book
     *
     * @param \AppBundle\Entity\Book $book
     *
     * @return delivery
     */
    public function setBook(\AppBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \AppBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return delivery
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set isReturned
     *
     * @param boolean $isReturned
     *
     * @return delivery
     */
    public function setIsReturned($isReturned)
    {
        $this->isReturned = $isReturned;

        return $this;
    }

    /**
     * Get isReturned
     *
     * @return boolean
     */
    public function getIsReturned()
    {
        return $this->isReturned;
    }
}
