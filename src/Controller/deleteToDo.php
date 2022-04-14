<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class deleteToDo extends AbstractController
{
/**
 * @Route ("/todo/deletion")
 */
public function del(Request $req)
{
    $sesh = $req->getSession();
    $todos = $sesh->get("todos");
    $key='achat';//the key of the attribute we want to delete
    if (isset($todos[$key]))
    {
        unset($todos[$key]);
        $sesh->set("todos",$todos);
        $this->addFlash('success', 'Flash Message:'.$key.' a ete supprime');
    }
    else
    {
        $this->addFlash('failure',"Flash Message:".$key." n'existe pas dans la liste");
    }
    return $this->render("liste/listeToDo.html.twig", array("todos" => $todos));
}
}