<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\delivery;
/**
 * Returns
 *
 * @ORM\Table(name="returns")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReturnsRepository")
 */
class Returns
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
     * @ORM\Column(name="date_return", type="date")
     */
    private $dateReturn;

    /**
     * One return has One delivery.
     * @ORM\OneToOne(targetEntity="delivery", inversedBy="Returns")
     * @ORM\JoinColumn(name="delivery_id", referencedColumnName="id")
     */
    private $delivery;

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
     * Set dateReturn
     *
     * @param \DateTime $dateReturn
     *
     * @return Returns
     */
    public function setDateReturn($dateReturn)
    {
        $this->dateReturn = $dateReturn;

        return $this;
    }

    /**
     * Get dateReturn
     *
     * @return \DateTime
     */
    public function getDateReturn()
    {
        return $this->dateReturn;
    }

    /**
     * Set delivery
     *
     * @param \AppBundle\Entity\delivery $delivery
     *
     * @return Returns
     */
    public function setDelivery(\AppBundle\Entity\delivery $delivery = null)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return \AppBundle\Entity\delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
}
