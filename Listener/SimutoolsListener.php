<?php

namespace CPASimUSante\SimutoolsBundle\Listener;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Claroline\CoreBundle\Event\DisplayToolEvent;
use Claroline\CoreBundle\Event\ConfigureDesktopToolEvent;
use Claroline\CoreBundle\Event\ConfigureWorkspaceToolEvent;

/**
 *  @DI\Service()
 */
class SimutoolsListener
{
    private $container;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @DI\Observe("open_tool_workspace_simutools")
     *
     * @param DisplayToolEvent $event
     */
    public function onDisplayWorkspace(DisplayToolEvent $event)
    {
        $event->setContent('Change me for workspace !');
    }

    /**
     * @DI\Observe("open_tool_desktop_simutools")
     *
     * @param DisplayToolEvent $event
     */
    public function onDisplayDesktop(DisplayToolEvent $event)
    {
        $event->setContent('Change me for desktop !');
    }

    /**
     * @DI\Observe("configure_tool_workspace_simutools")
     *
     * @param ConfigureWorkspaceToolEvent $event
     */
    public function onConfigureWorkspace(ConfigureWorkspaceToolEvent $event)
    {
        $event->setContent('Configuration of workspace !');
    }

    /**
     * @DI\Observe("configure_tool_desktop_simutools")
     *
     * @param ConfigureDesktopToolEvent $event
     */
    public function onConfigureDesktop(ConfigureDesktopToolEvent $event)
    {
        $event->setContent('Configuration of desktop !');
    }
}