<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    /**
     * @Route ("/todo")
     */
    public function index(Request $req)
    {
        $sesh = $req->getSession();
        if ($sesh->has("todos")) {
            $todos = $sesh->get("todos");
        } else {
            $todos = array(
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            );
            $sesh->set("todos", $todos);
        }
        return $this->render("liste/listeToDo.html.twig", array("todos" => $todos));
    }
}