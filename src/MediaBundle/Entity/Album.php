<?php

namespace MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="MediaBundle\Repository\AlbumRepository")
 */
class Album
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
     * @ORM\Column(name="titleAlbum", type="string", length=255)
     */
    private $titleAlbum;

    /**
     * @var string
     *
     * @ORM\Column(name="artist", type="string", length=255)
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="support", type="string", length=255)
     */
    private $support;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text")
     */
    private $image;


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
     * Set titleAlbum
     *
     * @param string $titleAlbum
     *
     * @return Album
     */
    public function setTitleAlbum($titleAlbum)
    {
        $this->titleAlbum = $titleAlbum;

        return $this;
    }

    /**
     * Get titleAlbum
     *
     * @return string
     */
    public function getTitleAlbum()
    {
        return $this->titleAlbum;
    }

    /**
     * Set artist
     *
     * @param string $artist
     *
     * @return Album
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Album
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set support
     *
     * @param string $support
     *
     * @return Album
     */
    public function setSupport($support)
    {
        $this->support = $support;

        return $this;
    }

    /**
     * Get support
     *
     * @return string
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
