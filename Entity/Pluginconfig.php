<?php

namespace CPASimUSante\SimutoolsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pluginconfig
 *
 * @ORM\Table(name="cpasimusante_simutools_pluginconfig")
 * @ORM\Entity(repositoryClass="CPASimUSante\SimutoolsBundle\Repository\PluginconfigRepository")
 */
class Pluginconfig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="param", type="string", length=255)
     */
    private $param;


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
     * Set param
     *
     * @param string $param
     *
     * @return Pluginconfig
     */
    public function setParam($param)
    {
        $this->param = $param;

        return $this;
    }

    /**
     * Get param
     *
     * @return string
     */
    public function getParam()
    {
        return $this->param;
    }
}

