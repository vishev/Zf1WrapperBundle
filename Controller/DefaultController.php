<?php

namespace MainlyCode\Zf1WrapperBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * indexAction
     *
     * @param string $url
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($url)
    {
        $requestUri = $this->getRequest()->getRequestUri();
        //var_dump($requestUri);

        // capture content from legacy application
        $rootDir   = $this->get('kernel')->getRootDir();
        $bootstrap = $this->container->getParameter('zf1wrapper_bootstrap_path');

        ob_start();
        include $rootDir . '/' . $bootstrap;
        $content = ob_get_clean();

        // exit on Location header
        $matches = array_filter(headers_list(), function ($v) { return 'Location:' == substr($v, 0, 9); });
        if (count($matches) >0) {
            exit;
        }

        return new Response($content);
    }
}
