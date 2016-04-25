<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Form\RegisterType;
use AppBundle\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\ResidentRepository;

/**
 * Controller used to manage blog contents in the backend.
 *
 * Please note that the application backend is developed manually for learning
 * purposes. However, in your real Symfony application you should use any of the
 * existing bundles that let you generate ready-to-use backends without effort.
 * See http://knpbundles.com/keyword/admin
 * @Route("/event/register")
 */
class EventController extends Controller {

    /**
     * Creates a new Post entity.
     *
     * @Route("/new/{event_id}", name="register_new", defaults={"event_id" = 3})
     * @Method({"GET", "POST"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function newAction(Request $request, $event_id) {
        $event = NULL;
        if ($event_id != NULL) {
            $event = $this->getDoctrine()
                    ->getRepository('AppBundle:Event')
                    ->find($event_id);
        }
        $resident = new \AppBundle\Entity\Resident();
        $resident->setEventId($event_id);
        $form = $this->createForm(new RegisterType(), $resident);
        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resident);
            $numParticipant = 0;
            foreach ($resident->getParticipants() as $participant) {
                $participant->setResident($resident);
                $numParticipant++;
            }

            //reduce the number of available slots
            $currentOccupancy = $event->getFreeOccupancy();
            $event->setFreeOccupancy($currentOccupancy - $numParticipant);
            $em->persist($event);
            $em->flush();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'register.basic_saved');

            return $this->redirectToRoute('register_show_detail', array(
                        'resident_id' => $resident->getId(),
            ));
        }

        return $this->render('event/new.html.twig', array(
                    'register' => $resident,
                    'form' => $form->createView(),
                    'event' => $event,
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/show/{resident_id}", requirements={"resident_id" = "\d+"}, name="register_show_detail")
     * @Method("GET")
     */
    public function showAction($resident_id) {
        // This security check can also be performed:
        //   1. Using an annotation: @Security("post.isAuthor(user)")
        //   2. Using a "voter" (see http://symfony.com/doc/current/cookbook/security/voters_data_permission.html)

        $resident = $this->getDoctrine()
                ->getRepository('AppBundle:Resident')
                ->find($resident_id);
        $deleteForm = $this->createDeleteForm($resident);

        return $this->render('event/show.html.twig', array(
                    'resident' => $resident,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * This is necessary because browsers don't support HTTP methods different
     * from GET and POST. Since the controller that removes the blog posts expects
     * a DELETE method, the trick is to create a simple form that *fakes* the
     * HTTP DELETE method.
     * See http://symfony.com/doc/current/cookbook/routing/method_parameters.html.
     *
     * @param ClientRecord $resident The post object
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(\AppBundle\Entity\Resident $resident) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('delete_registration', array('id' => $resident->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/delete/{id}", name="delete_registration")
     * @Method("DELETE")
     *
     * The Security annotation value is an expression (if it evaluates to false,
     * the authorization mechanism will prevent the user accessing this resource).
     * The isAuthor() method is defined in the AppBundle\Entity\Post entity.
     */
    public function deleteAction(Request $request, $id) {
        $resident = $this->getDoctrine()
                ->getRepository('AppBundle:Resident')
                ->find($id);
        $event_id = $resident->getEventId();
        $event = $this->getDoctrine()
                ->getRepository('AppBundle:Event')
                ->find($event_id);
        $numParticipants = 0;
        foreach ($resident->getParticipants() as $participant) {
            $numParticipants++;
        }

        $form = $this->createDeleteForm($resident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //reduce the number of available slots
            $currentOccupancy = $event->getFreeOccupancy();
            $event->setFreeOccupancy($currentOccupancy - $numParticipants);
            $entityManager->persist($event);
            
            $entityManager->remove($resident);
            $entityManager->flush();

            $this->addFlash('success', 'record.deleted_successfully');
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/edit/{id}", name="edit_registration")
     * @Method({"GET", "POST"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function editAction(Request $request, $id) {
        $resident = $this->getDoctrine()
                ->getRepository('AppBundle:Resident')
                ->find($id);
        $event_id = $resident->getEventId();
        $event = $this->getDoctrine()
                ->getRepository('AppBundle:Event')
                ->find($event_id);
        $oldNumParticipant = 0;
        foreach ($resident->getParticipants() as $participant) {
            $oldNumParticipant++;
        }
        $form = $this->createForm(new RegisterType(), $resident);
        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resident);
            $numParticipant = 0;
            foreach ($resident->getParticipants() as $participant) {
                $numParticipant++;
                $participant->setResident($resident);
            }

            //reduce the number of available slots
            $currentOccupancy = $event->getFreeOccupancy();
            $event->setFreeOccupancy($currentOccupancy + $oldNumParticipant - $numParticipant);
            $em->persist($event);

            $em->flush();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'register.basic_saved');

            return $this->redirectToRoute('register_show_detail', array(
                        'resident_id' => $resident->getId(),
            ));
        }

        return $this->render('event/new.html.twig', array(
                    'register' => $resident,
                    'form' => $form->createView(),
                    'event' => $event,
        ));
    }
    /**
     * Search registration.
     *
     * @Route("/search/{event_id}", name="search_registration", defaults={"event_id" = 3})
     * @Method({"GET", "POST"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function searchAction(Request $request, $event_id) {
        $event = NULL;
        if ($event_id != NULL) {
            $event = $this->getDoctrine()
                    ->getRepository('AppBundle:Event')
                    ->find($event_id);
        }
        $resident = new \AppBundle\Entity\Resident();
        $form = $this->createForm(new SearchType(), $resident);
        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $firstName = $resident->getFirstName();
            $lastName = $resident->getLastName();
            $email = $resident->getEmail();
            
            $repo = $this->getDoctrine()
                         ->getRepository('AppBundle:Resident');
            $match_resident = $repo->getOneResidentBySearch($firstName, 
                                                    $lastName, 
                                                    $email); 
            if($match_resident != NULL){
                return $this->redirectToRoute('register_show_detail', array(
                        'resident_id' => $match_resident->getId(),
                ));
            }else{
                $this->addFlash('success', 'search.not_found');
                return $this->render('event/search.html.twig', array(
                    'register' => $resident,
                    'form' => $form->createView(),
                    'event' => $event,
                ));
            }

            return $this->redirectToRoute('register_show_detail', array(
                        'resident_id' => $resident->getId(),
            ));
        }

        return $this->render('event/search.html.twig', array(
                    'register' => $resident,
                    'form' => $form->createView(),
                    'event' => $event,
        ));
    }

}
