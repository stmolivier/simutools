<?php

namespace CPASimUSante\SimutoolsBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CPASimUSante\SimutoolsBundle\Entity\Pluginconfig;
use CPASimUSante\SimutoolsBundle\Manager\PluginconfigManager;
use CPASimUSante\SimutoolsBundle\Exception\InvalidPluginconfigFormException;

/**
 * Class SimutoolsController
 * @package CPASimUSante\SimutoolsBundle\Controller
 *
 * @EXT\Route("/cpasimusante/simutools")
 */
class SimutoolsController extends Controller
{
    private $pcManager;
    /**
     * @DI\InjectParams({
     *      "pcManager" = @DI\Inject("simutools.plugin.manager.pluginconfig")
     * })
     * @param PluginconfigManager $pcManager
     */
    public function __construct(
        PluginconfigManager $pcManager
    )
    {
        $this->pcManager = $pcManager;
    }

    /**
     * @EXT\Route("/update", name="cpasimusante_pluginconfig_update")
     * @EXT\Method({"GET", "POST"})
     * @EXT\Template("CPASimUSanteSimutoolsBundle:Tools:pluginconfig.html.twig")
     *
     * @param Request $request
     * @return Response
     */
    public function updateAction(Request $request)
    {
        //only admin access
        $this->checkAdmin();
        //retrieve the plugin config
        $pluginconfig = $this->pcManager->getPluginconfig();

        try {
            $pluginconfig = $this->pcManager->processForm($pluginconfig, $request);
        } catch (InvalidPluginconfigFormException $e) {
            return array('form' => $e->getForm()->createView());
        }
        //redirect when validated
        $response = $this->forward(
            "CPASimUSanteSimutoolsBundle:Simutools:success",
            array(
                'pluginconfig' => $pluginconfig
            )
        );

        return $response;
    }

    /**
     * @EXT\Route("/update/success", name="cpasimusante_pluginconfig_update_success")
     * @EXT\Method({"GET"})
     * @EXT\Template("CPASimUSanteSimutoolsBundle:Tools:pluginconfigsuccess.html.twig")
     *
     * @param Pluginconfig $pluginconfig
     * @return array
     */
    public function successAction(Pluginconfig $pluginconfig = null)
    {
        $this->checkAdmin();
        //parm to be returned
        return array(
            'pluginconfig' => $pluginconfig
        );
    }
}
