<?php

namespace CPASimUSante\SimutoolsBundle\Manager;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormFactoryInterface;
use Claroline\CoreBundle\Persistence\ObjectManager;
use CPASimUSante\SimutoolsBundle\Entity\Pluginconfig;
use CPASimUSante\SimutoolsBundle\Repository\PluginconfigRepository;
use CPASimUSante\SimutoolsBundle\Exception\InvalidPluginconfigFormException;
use CPASimUSante\SimutoolsBundle\Exception\NoPluginconfigException;
use Symfony\Component\HttpFoundation\Request;


/**
 * @DI\Service("cpasimusante.plugin.manager.pluginconfig")
 */
class PluginconfigManager
{
    /**
     * @var object object manager
     */
    private $om;

    private $em;
    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    private $formFactory;

    /**
     * @DI\InjectParams({
     *      "em"                    = @DI\Inject("doctrine.orm.entity_manager"),
     *      "formFactory"           = @DI\Inject("form.factory"),
     *      "om"                    = @DI\Inject("claroline.persistence.object_manager")
     * })
     * @param EntityManager $em
     * @param FormFactoryInterface $formFactory
     * @param ObjectManager $om
     */
    public function __construct(
        EntityManager $em,
        FormFactoryInterface $formFactory,
        ObjectManager $om
    ) {
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->om = $om;
    }

    /**
     * @return mixed
     */
    public function getPluginconfig()
    {
        $pluginconfig = $this->em->getRepository("CPASimUSanteSimutoolsBundle:Pluginconfig")->findAll();
        //no config set
        if (sizeof($pluginconfig) == 0)
        {
            return new Pluginconfig();
        }
        else
        {
            return $pluginconfig[0];
        }
    }

    /**
     * return a Pluginconfig
     * @return Pluginconfig|mixed
     */
    public function getPluginconfigOrEmpty()
    {
        try {
            return $this->getPluginconfig();
        } catch (NoPluginconfigException $e) {
            return new Pluginconfig();
        }
    }

    /**
     * @param Pluginconfig $pluginconfig
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getPluginconfigForm(Pluginconfig $pluginconfig = null)
    {
        if ($pluginconfig === null) $pluginconfig = $this->getPluginconfigOrEmpty();
        $form = $this->formFactory->create(
            'cpasimusante_simutoolsbundle_pluginconfig',    //factory name (in CPASimUSante\SimutoolsBundle\Form\PluginconfigType)
            $pluginconfig
        );

        return $form;
    }

    /**
     * configuration form process
     *
     * @param Pluginconfig $pluginconfig
     * @param Request $request
     * @return Pluginconfig
     * @throws InvalidPluginconfigFormException
     */
    public function processForm(Pluginconfig $pluginconfig, Request $request)
    {
        $form = $this->getPluginconfigForm($pluginconfig);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $pluginconfig = $form->getData();
            $this->em->persist($pluginconfig);
            $this->em->flush();
//var_dump($pluginconfig);die('argh');
            return $pluginconfig;
        }

        throw new InvalidPluginconfigFormException('invalid_text', $form);
    }
}