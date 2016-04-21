<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Controller used to manage blog contents in the backend.
 *
 * Please note that the application backend is developed manually for learning
 * purposes. However, in your real Symfony application you should use any of the
 * existing bundles that let you generate ready-to-use backends without effort.
 * See http://knpbundles.com/keyword/admin
 * @Route("/event/admin")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class EventAdminController extends Controller {

    /**
     * Lists all Post entities.
     *
     * This controller responds to two different routes with the same URL:
     *   * 'admin_post_index' is the route with a name that follows the same
     *     structure as the rest of the controllers of this class.
     *   * 'admin_index' is a nice shortcut to the backend homepage. This allows
     *     to create simpler links in the templates. Moreover, in the future we
     *     could move this annotation to any other controller while maintaining
     *     the route name and therefore, without breaking any existing link.
     *
     * @Route("/{event_id}", name="admin_registration_index", defaults={"event_id" = 3})
     * @Method({"GET", "POST"})
     */
    public function indexAction($event_id) { 
        $event = NULL;        
        if ($event_id != NULL) {
            $event = $this->getDoctrine()
                    ->getRepository('AppBundle:Event')
                    ->find($event_id);
        }
        $entityManager = $this->getDoctrine()->getManager();
        
        $residents = $entityManager->getRepository('AppBundle:Resident')->findAll();
        return $this->render('event/index.html.twig', array(
            'residents' => $residents,
            'event'=>$event
        ));
    }

    

}
