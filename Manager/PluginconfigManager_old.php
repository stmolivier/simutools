<?php

namespace CPASimUSante\SimutoolsBundle\Manager;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormFactoryInterface;
use CPASimUSante\SimutoolsBundle\Entity\Pluginconfig;
use CPASimUSante\SimutoolsBundle\Entity\PluginconfigRepository;
use CPASimUSante\SimutoolsBundle\Exception\InvalidPluginconfigFormException;
use Symfony\Component\HttpFoundation\Request;


/**
 *
 * ("cpasimusante.plugin.manager.simutools")
 */
class PluginconfigManager_old
{
    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    private $formFactory;
    private $em;
    private $pcRepository;

    /**
     * @DI\InjectParams({
     *      "em"                    = @DI\Inject("doctrine.orm.entity_manager"),
     *      "formFactory"           = @DI\Inject("form.factory")
     * })
     * @param FormFactoryInterface $formFactory
     * @param EntityManager $em
     * @param PluginconfigRepository $pcRepository
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManager $em,
        PluginconfigRepository $pcRepository
    ) {
        $this->formFactory = $formFactory;
        $this->pcRepository = $pcRepository;
        $this->em = $em;
    }

    public function getPluginconfig()
    {
        $pluginconfig = $this->pcRepository->findAll();
        return $pluginconfig[0];
    }

    /**
     * @param Pluginconfig $pluginconfig
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getPluginconfigForm(Pluginconfig $pluginconfig = null)
    {
    //    if ($pluginconfig === null) $pluginconfig = $this->getMediacenterOrEmpty();
        $form = $this->formFactory->create(
            'cpasimusante_simutoolsbundle_pluginconfig',    //factory name (in CPASimUSante\SimutoolsBundle\Form\PluginconfigType)
            $pluginconfig
        );

        return $form;
    }

    /**
     * config form process
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