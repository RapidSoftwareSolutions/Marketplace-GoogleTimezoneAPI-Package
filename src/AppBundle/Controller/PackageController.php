<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author Dmitry Shumytskyi <d.shumytskyi@gmail.com>
 */
class PackageController extends Controller
{
    /**
     *
     * @Route("/api/{packageName}", requirements={"packageName": "GoogleTimezoneAPI"})
     * @Method({"GET"})
     *
     * @return JsonResponse
     */
    public function metadataAction()
    {
        return new JsonResponse($this->getParameter('app_bundle.metadata'));
    }

    /**
     * @Route("/api/{packageName}/getTimeZone", requirements={"packageName": "GoogleTimezoneAPI"})
     * @Method({"POST"})
     *
     * @return mixed
     */
    public function getTimeZoneAction()
    {
        $graph = $this->get('app_bundle.package');

        $callback = $graph->getCallback('getTimeZone');

        $callback($this->getParameter('app_bundle.get_timezone'));

        return new JsonResponse($graph->getResponse());
    }

    /**
     * @Route("/api/{packageName}/getLocalTime", requirements={"packageName": "GoogleTimezoneAPI"})
     * @Method({"POST"})
     *
     * @return mixed
     */
    public function getLocalTimeAction()
    {
        $graph = $this->get('app_bundle.package');

        $callback = $graph->getCallback('getLocalTime');

        $callback($this->getParameter('app_bundle.get_local_time'));

        return new JsonResponse($graph->getResponse());
    }

}