<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", name="update_time", nullable=true)
     */
    private $updateTime;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reply", mappedBy="message", cascade={"remove"})
     */
    private $reply;

    public function __construct()
    {
        $this->reply = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(?string $content)
    {
        $this->content = $content;

        return $this;
    }

    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    public function putData($id, $name, $content, $updateTime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->updateTime = $updateTime;
        return true;
    }

    /**
     * @return Collection|Reply[]
     */
    public function getReply()
    {
        return $this->reply;
    }
}
