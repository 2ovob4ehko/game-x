<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="fights")
*/
class Fights
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
  protected $turn;

  /**
  * @ORM\OneToMany(targetEntity="Users", mappedBy="fights")
  */
  protected $users;

  public function __construct()
  {
    $this->users = new ArrayCollection();
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
     * Set turn
     *
     * @param integer $turn
     * @return Fights
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return integer
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Add users
     *
     * @param \AppBundle\Entity\Users $users
     * @return Fights
     */
    public function addUser(\AppBundle\Entity\Users $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \AppBundle\Entity\Users $users
     */
    public function removeUser(\AppBundle\Entity\Users $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
    public function setParam($param,$value)
    {
        $this->$param = $value;

        return $this;
    }
}
