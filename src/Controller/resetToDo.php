<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class resetToDo extends AbstractController
{
/**
 * @Route ("/todo/reset")
 */
public function index(Request $req)
{
    $sesh = $req->getSession();
    $todos=$sesh->get("todos");

    if ($todos==null)
    {
        $this->addFlash("failure", "La liste n'est pas encore initialise");
        return $this->render("liste/listeToDo.html.twig",array("todos"=>null));
    }
    $todo= array(
        'achat' => 'acheter clé usb',
        'cours' => 'Finaliser mon cours',
        'correction' => 'corriger mes examens'
    );
    $bool=false;
    if(count($todos)!=count($todo))
        $bool=true;
    else
    {
        foreach ($todos as $value)
        {
            $key=array_search($value,$todos);
            if(!isset($todo[$key])or $value!=$todo[$key])
            {
                $bool=true;
                break;
            }
        }
    }

    $sesh->clear();
    $sesh = $req->getSession();
    if($bool)
        $this->addFlash("success","La liste a ete reinitialise avec succes");
    $sesh->set("todos", $todo);
    return $this->render("liste/listeToDo.html.twig", array("todos" => $todo));
}
}