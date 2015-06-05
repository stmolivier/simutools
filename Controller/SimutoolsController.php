<?php

namespace CPASimUSante\SimutoolsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SimutoolsController
 * @package CPASimUSante\SimutoolsBundle\Controller
 *
 * @EXT\Route("/cpasimusante/simutools")
 */
class SimutoolsController extends Controller
{
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

        //redirect when validated
        $response = $this->forward(
            "CPASimUSanteSimutoolsBundle:Simutools:success",
            array(

            )
        );

        return $response;
    }

    /**
     * @EXT\Route("/update/success", name="cpasimusante_pluginconfig_update_success")
     * @EXT\Method({"GET"})
     * @EXT\Template("CPASimUSanteSimutoolsBundle:Tools:pluginconfigsuccess.html.twig")
     *
     * @return array
     */
    public function successAction()
    {
        $this->checkAdmin();
        //parm to be returned
        return array(

        );
    }
}
