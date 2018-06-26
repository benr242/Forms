<?php
/**
 * Created by PhpStorm.
 * User: benr242
 * Date: 4/19/18
 * Time: 9:18 PM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WSController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
}