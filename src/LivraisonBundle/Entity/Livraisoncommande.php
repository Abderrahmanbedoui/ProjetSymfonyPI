<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraisoncommande
 *
 * @ORM\Table(name="livraisoncommande", indexes={@ORM\Index(name="add_forignkey_idlivraison", columns={"idLivraison"})})
 * @ORM\Entity
 */
class Livraisoncommande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPersonne", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idpersonne;

    /**
     * @var \Livraison
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Livraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLivraison", referencedColumnName="id")
     * })
     */
    private $idlivraison;


}

