<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="classes")
*/
class Classes
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  protected $id;

  /**
  * @ORM\Column(type="string")
  */
  protected $img;

  /**
  * @ORM\Column(type="string")
  */
  protected $name;

  /**
  * @ORM\Column(type="integer")
  */
  protected $health;

  /**
  * @ORM\Column(type="integer")
  */
  protected $power;

  /**
  * @ORM\Column(type="integer")
  */
  protected $defense;

  /**
  * @ORM\Column(type="integer")
  */
  protected $length_go;

  /**
  * @ORM\Column(type="integer")
  */
  protected $length_attack;

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
     * Set img
     *
     * @param string $img
     * @return Classes
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Classes
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set health
     *
     * @param integer $health
     * @return Classes
     */
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get health
     *
     * @return integer
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set power
     *
     * @param integer $power
     * @return Classes
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return integer
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set length_go
     *
     * @param integer $lengthGo
     * @return Classes
     */
    public function setLengthGo($lengthGo)
    {
        $this->length_go = $lengthGo;

        return $this;
    }

    /**
     * Get length_go
     *
     * @return integer
     */
    public function getLengthGo()
    {
        return $this->length_go;
    }

    /**
     * Set length_attack
     *
     * @param integer $lengthAttack
     * @return Classes
     */
    public function setLengthAttack($lengthAttack)
    {
        $this->length_attack = $lengthAttack;

        return $this;
    }

    /**
     * Get length_attack
     *
     * @return integer
     */
    public function getLengthAttack()
    {
        return $this->length_attack;
    }

    /**
     * Set defense
     *
     * @param integer $defense
     * @return Classes
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get defense
     *
     * @return integer 
     */
    public function getDefense()
    {
        return $this->defense;
    }
}
