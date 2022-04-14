<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddToDoController extends AbstractController
{
    /**
     * @Route("/todo/newtodo")
     */
    public function addToDoAction(Request $req)
    {

        $sesh = $req->getSession();
        //$sesh->clear();//test for failure
        $todos = $sesh->get("todos");
        if ($todos==null)
        {
                $this->addFlash("failure", "La liste n'est pas encore initialise");
                return $this->redirect("/todo");
        }
        $key='achat';//the key of the attribute we want to change
        $value='todo';//new value
        if ((!isset($todos[$key])) or ($todos[$key]!=$value))
        {
                $todos[$key]=$value;
                 $sesh->set("todos",$todos);
                $this->addFlash('success', 'Flash Message:'.$key.' a ete mise a jour');
        }
        return $this->render("liste/listeToDo.html.twig", array("todos" => $todos));
    }
}