<?php

namespace MainlyCode\Zf1WrapperBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Zend_Registry;

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
        // pass Dependency Injection Container
        Zend_Registry::set('dic', $this->container);

        $rootDir   = $this->get('kernel')->getRootDir();
        $bootstrap = $this->container->getParameter('zf1wrapper_bootstrap_path');

        // capture content from legacy application
        ob_start();
        include $rootDir . '/' . $bootstrap;
        $content = ob_get_clean();

        // capture http response code (requires PHP >= 5.4.0)
        if (function_exists('http_response_code') && http_response_code() > 0) {
            $code = http_response_code();
        } else {
            $code = 200;
        }

        // capture headers
        $headersSent = headers_list();
        $headers     = array();

        array_walk($headersSent, function($value, $key) use(&$headers) {
            $parts = explode(': ', $value);
            $headers[$parts[0]] = $parts[1];
        });
        header_remove();

        return new Response($content, $code, $headers);
    }
}
