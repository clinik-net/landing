<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use GuzzleHttp\Client;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function signupAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $name = $request->getPost('name');
            $mail = $request->getPost('mail');
            $passwd = $request->getPost('password');
            
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'http://api.medivo.local',
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
            $body = json_encode([
                        'name' => $name,
                        'email' => $mail,
                        "password" => $passwd,
                        'deviceId' => 'dskjlfhewfewhfhwefherwf'
                    ]);
            $response = $client->request(
                'POST',
                '/user',
                [ 'body' => $body ]
            );

            var_dump($response);die();

        }
        return new ViewModel();
    }

    public function signinAction()
    {
        return new ViewModel();
    }

    public function featuresAction()
    {
        return new ViewModel();
    }
}
