<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="heroes")
*/
class Heroes
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
  * @ORM\Column(type="string")
  */
  protected $title;

  /**
  * @ORM\Column(type="integer")
  */
  protected $goal_x;

  /**
  * @ORM\Column(type="integer")
  */
  protected $goal_y;

  /**
  * @ORM\ManyToOne(targetEntity="Users", inversedBy="heroes")
  * @ORM\JoinColumn(name="users_id", referencedColumnName="id")
  */
  protected $user;

  /**
  * @ORM\OneToMany(targetEntity="Warriors", mappedBy="heroes")
  */
  protected $warriors;

  public function __construct()
  {
    $this->warriors = new ArrayCollection();
  }

  /**
  * @ORM\ManyToOne(targetEntity="Fights", inversedBy="heroes")
  * @ORM\JoinColumn(name="fight_id", referencedColumnName="id")
  */
  protected $fight;

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
     * @return Heroes
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
     * @return Heroes
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
     * Set title
     *
     * @param string $title
     * @return Heroes
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set goal_x
     *
     * @param integer $goalX
     * @return Heroes
     */
    public function setGoalX($goalX)
    {
        $this->goal_x = $goalX;

        return $this;
    }

    /**
     * Get goal_x
     *
     * @return integer
     */
    public function getGoalX()
    {
        return $this->goal_x;
    }

    /**
     * Set goal_y
     *
     * @param integer $goalY
     * @return Heroes
     */
    public function setGoalY($goalY)
    {
        $this->goal_y = $goalY;

        return $this;
    }

    /**
     * Get goal_y
     *
     * @return integer
     */
    public function getGoalY()
    {
        return $this->goal_y;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     * @return Heroes
     */
    public function setUser(\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    public function setParam($param,$value)
    {
        $this->$param = $value;

        return $this;
    }

    /**
     * Add warriors
     *
     * @param \AppBundle\Entity\Warriors $warriors
     * @return Heroes
     */
    public function addWarrior(\AppBundle\Entity\Warriors $warriors)
    {
        $this->warriors[] = $warriors;

        return $this;
    }

    /**
     * Remove warriors
     *
     * @param \AppBundle\Entity\Warriors $warriors
     */
    public function removeWarrior(\AppBundle\Entity\Warriors $warriors)
    {
        $this->warriors->removeElement($warriors);
    }

    /**
     * Get warriors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWarriors()
    {
        return $this->warriors;
    }

    /**
     * Set fight
     *
     * @param \AppBundle\Entity\Fights $fight
     * @return Heroes
     */
    public function setFight(\AppBundle\Entity\Fights $fight = null)
    {
        $this->fight = $fight;

        return $this;
    }

    /**
     * Get fight
     *
     * @return \AppBundle\Entity\Fights
     */
    public function getFight()
    {
        return $this->fight;
    }
}
