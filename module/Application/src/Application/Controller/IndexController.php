<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function signupAction()
    {
        $request = $this->getRequest();

        if ($request->isPost() ) {
            $name = $request->getPost('name');
            $mail = $request->getPost('mail');
            $passwd = $request->getPost('password');
            
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => '//api.medivo.mx',
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
            $body = json_encode([
                        'name' => $name,
                        'email' => $mail,
                        "password" => $passwd,
                        'deviceId' => 'dskjlfhewfewhfhwefherwf'
                    ]);

            try {
                $response = $client->request(
                    'POST',
                    '/user',
                    [ 
                        'body' => $body,
                        'http_errors' => false
                    ]
                );

                $code = $response->getStatusCode();


                $content = $response->getBody();
                $body = json_decode( $content->getContents() );

                $error = $body->error;
                $message = $body->message;



                if ( 201 === $code ) {
                    $mess = "Created";
                } elseif ( 409 === $code ) {
                    $mess = "Ya existe un usuario registrado con ese correo";
                } elseif ( 400 === $code ) {
                    $mess = "faltan datos para registrar, intenta de nuevo";
                }

                $view = new ViewModel(array(
                    'error' => $error,
                    'code' => $code,
                    'message' => $mess,
                    'name' => $name
                ));

                /*
                $reason = $response->getReasonPhrase();
                */
            } catch ( RequestException $e ) {
                echo Psr7\str($e->getResponse());
                echo "============";
                echo Psr7\str($e->getHeaders());
            }

            return $view;
        } // isPost() 

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
