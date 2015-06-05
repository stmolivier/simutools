<?php

namespace CPASimUSante\SimutoolsBundle\Listener;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Claroline\CoreBundle\Event\DisplayToolEvent;
use Claroline\CoreBundle\Event\ConfigureDesktopToolEvent;
use Claroline\CoreBundle\Event\ConfigureWorkspaceToolEvent;
use Claroline\CoreBundle\Event\PluginOptionsEvent;
use Symfony\Component\HttpFoundation\Response;

/**
 *  @DI\Service()
 */
class SimutoolsListener
{
    private $container;
    private $templating;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->templating = $container->get('templating');
    }

    /**
     * @DI\Observe("plugin_options_simutoolsbundle")
     *
     * @param PluginOptionsEvent $event
     */
    public function onPluginConfigure(PluginOptionsEvent $event)
    {
        $content = $this->templating->render(
            'CPASimUSanteSimutoolsBundle:Tools:pluginconfig.html.twig',
            array(

            )
        );
        //PluginOptionsEvent require a setResponse()
        $event->setResponse(new Response($content));
        $event->stopPropagation();
    }

    /**
     * @DI\Observe("open_tool_workspace_simutools")
     *
     * @param DisplayToolEvent $event
     */
    public function onDisplayWorkspace(DisplayToolEvent $event)
    {
        $content = $this->templating->render(
            'CPASimUSanteSimutoolsBundle:Tools:workspacedisplay.html.twig',
            array(

            )
        );
        $event->setContent($content);
    }

    /**
     * @DI\Observe("open_tool_desktop_simutools")
     *
     * @param DisplayToolEvent $event
     */
    public function onDisplayDesktop(DisplayToolEvent $event)
    {
        $content = $this->templating->render(
            'CPASimUSanteSimutoolsBundle:Tools:desktopdisplay.html.twig',
            array(

            )
        );
        $event->setContent($content);
    }

    /**
     * @DI\Observe("configure_tool_workspace_simutools")
     *
     * @param ConfigureWorkspaceToolEvent $event
     */
    public function onConfigureWorkspace(ConfigureWorkspaceToolEvent $event)
    {
        $content = $this->templating->render(
            'CPASimUSanteSimutoolsBundle:Tools:workspaceconfig.html.twig',
            array(

            )
        );
        $event->setContent($content);
    }

    /**
     * @DI\Observe("configure_tool_desktop_simutools")
     *
     * @param ConfigureDesktopToolEvent $event
     */
    public function onConfigureDesktop(ConfigureDesktopToolEvent $event)
    {
        $content = $this->templating->render(
            'CPASimUSanteSimutoolsBundle:Tools:desktopconfig.html.twig',
            array(

            )
        );
        $event->setContent($content);
    }
}