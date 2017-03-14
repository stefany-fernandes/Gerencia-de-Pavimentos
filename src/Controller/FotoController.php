<?php



namespace controller;
use Defeitos\Defeitos;
use Fotos\Foto;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Usuario\Usuario;

class FotoController
{
    protected  $user;
    protected  $session;

    public function criarLoginAction(Request $request){
        $this->session = new Session();
        if($request->getMethod() == 'POST') {
            $user = new Usuario($request->request->get('login'), hash("sha256",$request->request->get('senha').'jo38h'), $request->request->get('nome'));
            $user->tornarAdm();
            $user->save();
        }
        ob_start();
        include sprintf(__DIR__.'/../view/cadastrarlogin.php');
        return new Response(ob_get_clean());
    }


    public function render_view (string $route ){
        ob_start();
        include sprintf(__DIR__."/../view/$route.php");
        return new Response( ob_get_clean());
    }
    public function  loginAction ( Request $request)
    {
        $this->session= new Session();
        $user = $this->session->get('user');
        if ($request->getMethod()==  'POST'){

            $users = Usuario::load($request->request->get('usuario'));

                if(hash("sha256",$request->request->get('senha').'jo38h')==$users->getSenha()) {
                    $this->session = new Session();
                    $this->session->set('user',$users);
                    return new RedirectResponse('/trabalho2/front.php/index');
                }
            $this->session->getFlashBag()->add('info','Usuário/senha incorreto');
            }
            //colocar um flash message
        return $this->render_view('login');
    }

    public function savePicturesAction(Request $request) {
        $this->session = new Session();
        $usuario = $this->session->get('user');


        if ($request->getMethod() == 'POST') {
            //echo $_FILES['arq']['name'];
            $diretorioUpload = 'FotosUsuarios/';
            $uploadFile = $diretorioUpload. basename($_FILES['arq']['name']);

            if ($usuario->getNumFotos() != 0) {
                if (move_uploaded_file($_FILES['arq']['tmp_name'], $uploadFile)) {
                    echo "Arquivo válido e enviado com sucesso.\n";
                    $foto = new Foto($request->request->get('Nome'), $request->request->get('Defeito'), $uploadFile, $this->session->get('user')->getLogin());
                    $foto->save();
                    $usuario->diminuiFotos();
                    $usuario->save();
                    return new RedirectResponse('/trabalho2/front.php/index');
                } else {
                    echo "Possível ataque de upload de arquivo!\n";
                }
            }
            else {
                $this->session->getFlashBag()->add('info', 'Você excedeu seu limite de fotos');
            }
        }
        ob_start();
        include sprintf(__DIR__.'/../view/receberfoto.php');
        return new Response(ob_get_clean());
    }

    public function deleteAction (Request $request) {
        $b = Foto::load($request->request->get('A'));
        $b->delete();
        $A = __DIR__.'/../../web/'.$b->carregarFoto();
        unlink($A);
        return new RedirectResponse('/trabalho2/front.php/index');
    }

    public function mostraFotoAction(Request $request) {
        $this->session= new Session();
        $user = $this->session->get('user');
        ob_start();
        include sprintf(__DIR__.'/../view/mostrarimagem.php');
        return new Response(ob_get_clean());
    }

    public function salvaDefeitoAction(Request $request){
        $this->session= new Session();
        $usuario = $this->session->get('user');
        if ($request->getMethod() == "POST") {
            if($usuario->getNivel() == 1) {
                $defeito = new Defeitos($request->request->get('nomeDefeito'), $request->request->get('descricao'));
                $defeito->save();
                return new RedirectResponse('/trabalho2/front.php/mostrarimagem');
            }else{
                $this->session->getFlashBag()->add('info', 'Você não tem acesso à essa área.');
                //return new RedirectResponse('/trabalho2/front.php/mostrarimagem');
            }
        }
        ob_start();
        include sprintf(__DIR__.'/../view/recebeDefeito.php');
        return new Response(ob_get_clean());
    }

}