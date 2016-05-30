<?php

namespace Ens\SylvainDavenelBundle\Controller;

use Doctrine\DBAL\Exception\SyntaxErrorException;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="ens_home")
     */
    public function indexAction(Request $request)
    {
        $result = array();

        if ($request->get("keywords")) {
            $em = $this->getDoctrine()->getEntityManager();

            try {
                try {
                    $stmt = $em->getConnection()->prepare($request->get("keywords"));
                    $stmt->execute();
                    if (strpos($request->get("keywords"), 'select') !== false) {
		    	$result = $stmt->fetchAll();
		    }
                } catch (SyntaxErrorException $error) {
                    $result['error'] = "Bad request";
                }
            } catch (TableNotFoundException $pdo_error) {
                $result['error'] = "Bad request";
            }
        }

        return $this->render('EnsSylvainDavenelBundle:Default:index.html.twig', array(
            "result" => $result
        ));
    }

    /**
     * @Route("/login", name="ens_login")
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('EnsSylvainDavenelBundle:Default:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    /**
     * @Route("/login_check", name="ens_login_check")
     */
    public function loginCheckAction() {
        
    }

    /**
     * @Route("/logout", name="ens_logout")
     */
    public function logoutAction() {

    }
}
