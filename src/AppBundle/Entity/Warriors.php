<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="warriors")
*/
class Warriors
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  protected $id;

  /**
  * @ORM\Column(type="integer")
  */
  protected $x;

  /**
  * @ORM\Column(type="integer")
  */
  protected $y;

  /**
  * @ORM\ManyToOne(targetEntity="Classes", inversedBy="warriors")
  * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
  */
  protected $class;

  /**
  * @ORM\Column(type="integer")
  */
  protected $quantity;

  /**
  * @ORM\Column(type="integer")
  */
  protected $wound;

  /**
  * @ORM\Column(type="integer")
  */
  protected $tired;

  /**
  * @ORM\ManyToOne(targetEntity="Heroes", inversedBy="warriors")
  * @ORM\JoinColumn(name="hero_id", referencedColumnName="id")
  */
  protected $hero;

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
     * Set x
     *
     * @param integer $x
     * @return Warriors
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     * @return Warriors
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Warriors
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set class
     *
     * @param \AppBundle\Entity\Class $class
     * @return Warriors
     */
    public function setClass(\AppBundle\Entity\Classes $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \AppBundle\Entity\Classes
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set hero
     *
     * @param \AppBundle\Entity\Heroes $hero
     * @return Warriors
     */
    public function setHero(\AppBundle\Entity\Heroes $hero = null)
    {
        $this->hero = $hero;

        return $this;
    }

    /**
     * Get hero
     *
     * @return \AppBundle\Entity\Heroes
     */
    public function getHero()
    {
        return $this->hero;
    }

    /**
     * Set wound
     *
     * @param integer $wound
     * @return Warriors
     */
    public function setWound($wound)
    {
        $this->wound = $wound;

        return $this;
    }

    /**
     * Get wound
     *
     * @return integer
     */
    public function getWound()
    {
        return $this->wound;
    }

    public function setParam($param,$value)
    {
        $this->$param = $value;

        return $this;
    }

    /**
     * Set tired
     *
     * @param integer $tired
     * @return Warriors
     */
    public function setTired($tired)
    {
        $this->tired = $tired;

        return $this;
    }

    /**
     * Get tired
     *
     * @return integer 
     */
    public function getTired()
    {
        return $this->tired;
    }
}
