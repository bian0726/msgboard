<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReplyRepository")
 */
class Reply
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
     * @ORM\Column(type="string", length=254)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Message", inversedBy="reply")
     * @ORM\JoinColumn(nullable=false)
     */
    private $message;

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

    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    public function setUpdateTime(\DateTimeInterface $updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage(?Message $message)
    {
        $this->message = $message;

        return $this;
    }

        public function putData($id, $message)
    {
        $this->id = $id;
        $this->message = $message;
        
        return true;
    }
}
