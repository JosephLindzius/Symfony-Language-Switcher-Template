<?php

namespace App\Controller;

use App\Entity\Language;
use App\Form\LanguageSwitcherType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LanguageSwitcherController extends AbstractController
{
    /**
     * @Route("/language_switcher", name="language_switcher")
     */
    public function index(Request $request)
    {
//prepare the form again to handel & validate
        $switcher = $this->createForm(LanguageSwitcherType::class, null,
            [ //option
                'action' => $this->generateUrl('language_switcher'),
                'method' => 'POST'
            ]);

        //handle the request using form
        $switcher->handleRequest($request);

        //get the data from it
        /** @var Language $newLanguage */
        $newLanguage = $switcher->getData()['language'];

        //store the new language in a cookie
        if($switcher->isSubmitted() && $switcher->isValid()){
            setcookie('language', $newLanguage->getCode(), time()*60,'/',$_SERVER['HTTP_HOST']);
        }

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function getLanguageSwitcherForm(): FormView
    {
        $switcher = $this->createForm(LanguageSwitcherType::class, null,
            [ //option
                'action' => $this->generateUrl('language_switcher'),
                'method' => 'POST'
            ]);

        $language = $this->getDoctrine()->getRepository(Language::class)
            ->findOneBy(['code' => $_COOKIE['language'] ?? $this->getParameter('kernel.default_locale')]);
        $switcher->get('language')->setData($language); // not to set; just to show

        return $switcher->createView();
    }

    public function __toString()
    {
        return 'getLanguageSwitcherForm';
    }
}
