<?php
/**
 * Created by PhpStorm.
 * User: stefa
 * Date: 13/03/2017
 * Time: 21:43
 */

require_once  __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use framework\Framework;

$request= Request::createFromGlobals();

$routes= new Routing\RouteCollection();
$routes->add('index',new Routing\Route('/index',[
            '_controller'=>'Controller\FotoController::mostraFotoAction'
        ]
    )
);


$routes->add('mostrarfoto',new Routing\Route('/mostrarimagem',[
            '_controller'=>'Controller\FotoController::mostraFotoAction'
        ]
    )
);

$routes->add('recebe_defeito',new Routing\Route('/receberdefeito',[
            '_controller'=>'Controller\FotoController::salvaDefeitoAction'
        ]
    )
);

$routes->add('salvarfoto',new Routing\Route('/salvarfoto',[
            '_controller'=>'Controller\FotoController::savePicturesAction'
        ]
    )
);
$routes->add('cadastrologin',new Routing\Route('/cadastrologin',[
            '_controller'=>'Controller\FotoController::criarLoginAction'
        ]
    )
);

$routes->add('login_game',new Routing\Route('/login',[
            '_controller'=>'Controller\FotoController::loginAction'
        ]
    )
);
$routes->add('delete_Foto',new Routing\Route('/delete',[
            '_controller'=>'Controller\FotoController::deleteAction'
        ]
    )
);

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes,$context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$framework = new framework($matcher,$controllerResolver,$argumentResolver);
$response = $framework->handle($request);


$response->send();