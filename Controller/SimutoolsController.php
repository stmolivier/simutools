<?php

namespace CPASimUSante\SimutoolsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;

class SimutoolsController extends Controller
{
    /**
     * @EXT\Route("/index", name="cpasimusante_simutools_index")
     * @EXT\Template
     *
     * @return Response
     */
    public function indexAction()
    {
        throw new \Exception('hello');
    }
}
