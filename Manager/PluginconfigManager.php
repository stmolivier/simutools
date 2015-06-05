<?php

namespace CPASimUSante\SimutoolsBundle\Manager;
use Symfony\Component\Form\FormFactoryInterface;
use JMS\DiExtraBundle\Annotation as DI;
use CPASimUSante\SimutoolsBundle\Entity\Pluginconfig;

/**
 * @DI\Service("cpasimusante.plugin.manager.simutools")
 */
class PluginconfigManager
{
    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    private $formFactory;
    /**
     * @DI\InjectParams({
     *      "em"                    = @DI\Inject("doctrine.orm.entity_manager"),
     *      "formFactory"           = @DI\Inject("form.factory")
     * })
     */
    public function __construct(
        FormFactoryInterface $formFactory
    ) {
        $this->formFactory = $formFactory;
    }

    public function getPluginconfigForm(Pluginconfig $pluginconfig = null)
    {
    //    if ($pluginconfig === null) $pluginconfig = $this->getMediacenterOrEmpty();
        $form = $this->formFactory->create(
            'cpasimusante_simutoolsbundle_pluginconfig',    //factory name (in CPASimUSante\SimutoolsBundle\Form\PluginconfigType)
            $pluginconfig
        );

        return $form;
    }
}