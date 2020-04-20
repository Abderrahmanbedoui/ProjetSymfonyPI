<?php

namespace LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="Constraint_idLivreur", columns={"idLivreur"})})
 * @ORM\Entity
 */
class Livraison
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255, nullable=false)
     */
    private $destination;

    /**
     * @var float
     *
     * @ORM\Column(name="poid_disponible", type="float", precision=10, scale=0, nullable=false)
     */
    private $poidDisponible;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temp_estime", type="date", nullable=false)
     */
    private $tempEstime;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_livraison", type="integer", nullable=true)
     */
    private $noteLivraison;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLivreur", referencedColumnName="id")
     * })
     */
    private $idlivreur;

    /**
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @param string $depart
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return float
     */
    public function getPoidDisponible()
    {
        return $this->poidDisponible;
    }

    /**
     * @param float $poidDisponible
     */
    public function setPoidDisponible($poidDisponible)
    {
        $this->poidDisponible = $poidDisponible;
    }

    /**
     * @return \DateTime
     */
    public function getTempEstime()
    {
        return $this->tempEstime;
    }

    /**
     * @param \DateTime $tempEstime
     */
    public function setTempEstime($tempEstime)
    {
        $this->tempEstime = $tempEstime;
    }

    /**
     * @return int
     */
    public function getNoteLivraison()
    {
        return $this->noteLivraison;
    }

    /**
     * @param int $noteLivraison
     */
    public function setNoteLivraison($noteLivraison)
    {
        $this->noteLivraison = $noteLivraison;
    }

    /**
     * @return \User
     */
    public function getIdlivreur()
    {
        return $this->idlivreur;
    }

    /**
     * @param \User $idlivreur
     */
    public function setIdlivreur($idlivreur)
    {
        $this->idlivreur = $idlivreur;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



}

