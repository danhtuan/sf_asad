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

use AppBundle\Form\RecordBaseType;
use AppBundle\Form\RecordHealthType;
use AppBundle\Form\RecordAppointmentType;
use AppBundle\Form\RecordReviewType;
use AppBundle\Form\RecordSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\ClientRecord;

/**
 * Controller used to manage blog contents in the backend.
 *
 * Please note that the application backend is developed manually for learning
 * purposes. However, in your real Symfony application you should use any of the
 * existing bundles that let you generate ready-to-use backends without effort.
 * See http://knpbundles.com/keyword/admin
 * @Route("/")
 * @Route("/admin/record")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class RecordController extends Controller {

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
     * @Route("/index", name="admin_index")
     * @Route("/", name="admin_record_index")
     * @Method("GET")
     */
    public function indexAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $records = $entityManager->getRepository('AppBundle:ClientRecord')->findAll();

        return $this->render('admin/record/index.html.twig', array('records' => $records));
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/new", name="admin_record_new")
     * @Method({"GET", "POST"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function newAction(Request $request) {
        $record = NULL;
        $record_id = $request->query->get('record_id');
        if ($record_id == NULL) {
            $record = new \AppBundle\Entity\ClientRecord();
        } else {
            $record = $this->getDoctrine()
                    ->getRepository('AppBundle:ClientRecord')
                    ->find($record_id);
        }
        $record->setOperator($this->getUser());
        $record->setOperatorName($this->getUser()->getUsername());
        $form = $this->createForm(new RecordBaseType(), $record);
        $step = 1;

        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            if ($record_id == NULL) {
                $record->setDateOfCall(new \DateTime());
                $record->setClientID("000000000");
                $record->setPriority(1);
                $record->setStatus(0); //draft
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($record);
            $entityManager->flush();
            if ($record_id == NULL) {
                $formatted_value = sprintf("%06d", $record->getId());
                $clientID = "001" . $formatted_value;
                $record->setClientID($clientID);
                $entityManager->persist($record);
                $entityManager->flush();
            }

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'record.basic_saved');

            return $this->redirectToRoute('admin_record_new_health', array(
                        'record_id' => $record->getId(),
            ));
        }

        return $this->render('admin/record/new.html.twig', array(
                    'record' => $record,
                    'form' => $form->createView(),
                    'step' => $step
        ));
    }

    /**
     * Creates a new Record entity/Health.
     *
     * @Route("/new/health", name="admin_record_new_health")
     * @Method({"GET", "POST"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function newHealthAction(Request $request) {
        $record_id = $request->query->get('record_id');
        $clientRecord = $this->getDoctrine()
                ->getRepository('AppBundle:ClientRecord')
                ->find($record_id);
        if (count($clientRecord->getHealthRecord()) > 0) {
            $healthRecord = $clientRecord->getHealthRecord()->first();
        } else {
            $healthRecord = new \AppBundle\Entity\ClientHealthRecord();
        }
        $healthRecord->setClientRecord($clientRecord);
        $form = $this->createForm(new RecordHealthType(), $healthRecord);
        $step = 2;

        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($healthRecord);
            $entityManager->flush();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            if ($healthRecord->getNumStillBirth() > 0 ||
                    $healthRecord->getNumMiscarriages() > 0 ||
                    $healthRecord->getNumAbortions() > 0 ||
                    $healthRecord->getNumTubalPreg() > 0 ||
                    $healthRecord->getIsCSection() ||
                    $healthRecord->getIsPainFever() ||
                    $healthRecord->getIsAbnormalBleeding() ||
                    $healthRecord->getIsUnusualDischarge() ||
                    $healthRecord->getIsHeadache() ||
                    $healthRecord->getIsSevereVomiting() ||
                    $healthRecord->getIsUTI() ||
                    $healthRecord->getIsSwelling() ||
                    $healthRecord->getIsCramping() ||
                    $healthRecord->getIsSafetyI() ||
                    $healthRecord->getIsSafetyII() ||
                    $healthRecord->getIsSafetyIII() ||
                    $healthRecord->getIsDiabetes() ||
                    $healthRecord->getIsHeartLungDisease() ||
                    $healthRecord->getIsSeizures() ||
                    $healthRecord->getIsThyroidProblems() ||
                    $healthRecord->getIsHighBloodPressure() ||
                    $healthRecord->getIsPrescriptionMeds()) {
                $clientRecord->setPriority(2);
                $entityManager->persist($clientRecord);
                $entityManager->flush();
            }
            $this->addFlash('success', 'record.health_saved_succesfully');
            if ($form->get('btn_back')->isClicked()) {
                return $this->redirectToRoute('admin_record_new', array(
                            'record_id' => $record_id,
                ));
            } else if ($form->get('btn_next')->isClicked()) {
                return $this->redirectToRoute('admin_record_new_appointment', array(
                            'record_id' => $record_id,
                ));
            }
        }

        return $this->render('admin/record/new.html.twig', array(
                    'record' => $clientRecord,
                    'form' => $form->createView(),
                    'step' => $step
        ));
    }

    /**
     * Creates a new Record entity/Appointment.
     *
     * @Route("/new/appointment", name="admin_record_new_appointment")
     * @Method({"GET", "POST"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function newAppointmentAction(Request $request) {
        $record_id = $request->query->get('record_id');
        $clientRecord = $this->getDoctrine()
                ->getRepository('AppBundle:ClientRecord')
                ->find($record_id);
        if (count($clientRecord->getClientAppointment()) > 0) {
            $clientAppointment = $clientRecord->getClientAppointment()->first();
        } else {
            $clientAppointment = new \AppBundle\Entity\ClientAppointment();
        }
        $clientAppointment->setClientRecord($clientRecord);
        $form = $this->createForm(new RecordAppointmentType(), $clientAppointment);
        $step = 3;

        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clientAppointment);
            $entityManager->flush();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'record.appointment_created_successfully');
            if ($form->get('btn_back')->isClicked()) {
                return $this->redirectToRoute('admin_record_new_health', array(
                            'record_id' => $record_id,
                ));
            } else if ($form->get('btn_next')->isClicked()) {
                return $this->redirectToRoute('admin_record_new_review', array(
                            'record_id' => $record_id,
                ));
            }
        }

        return $this->render('admin/record/new.html.twig', array(
                    'record' => $clientRecord,
                    'form' => $form->createView(),
                    'step' => $step
        ));
    }

    /**
     * Creates a new Record entity/Review.
     *
     * @Route("/new/review", name="admin_record_new_review")
     * @Method({"GET", "POST"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function newReviewAction(Request $request) {
        $record_id = $request->query->get('record_id');
        $clientRecord = $this->getDoctrine()
                ->getRepository('AppBundle:ClientRecord')
                ->find($record_id);
        $step = 4;
        $form = $this->createForm(new RecordReviewType(), $clientRecord);
        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('btn_back')->isClicked()) {
                return $this->redirectToRoute('admin_record_new_appointment', array(
                            'record_id' => $record_id,
                ));
            } else if ($form->get('btn_submit_list')->isClicked()) {
                $clientRecord->setStatus(1);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($clientRecord);
                $entityManager->flush();

                // Flash messages are used to notify the user about the result of the
                // actions. They are deleted automatically from the session as soon
                // as they are accessed.
                // See http://symfony.com/doc/current/book/controller.html#flash-messages
                $this->addFlash('success', 'record.created_successfully');
                return $this->redirectToRoute('admin_record_index', array(
                ));
            } else if ($form->get('btn_submit_new')->isClicked()) {
                $clientRecord->setStatus(1);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($clientRecord);
                $entityManager->flush();

                // Flash messages are used to notify the user about the result of the
                // actions. They are deleted automatically from the session as soon
                // as they are accessed.
                // See http://symfony.com/doc/current/book/controller.html#flash-messages
                $this->addFlash('success', 'record.created_successfully');
                return $this->redirectToRoute('admin_record_new', array(
                ));
            }
        }

        return $this->render('admin/record/new.html.twig', array(
                    'record' => $clientRecord,
                    'form' => $form->createView(),
                    'step' => $step
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="admin_record_show")
     * @Method("GET")
     */
    public function showAction(ClientRecord $clientRecord) {
        // This security check can also be performed:
        //   1. Using an annotation: @Security("post.isAuthor(user)")
        //   2. Using a "voter" (see http://symfony.com/doc/current/cookbook/security/voters_data_permission.html)

        $deleteForm = $this->createDeleteForm($clientRecord);

        return $this->render('admin/record/show.html.twig', array(
                    'record' => $clientRecord,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", requirements={"id" = "\d+"}, name="admin_record_edit")
     * @Method({"GET", "POST"})
     */
    public function editRecord(ClientRecord $clientRecord, Request $request) {
        $clientRecord->setOperatorName($this->getUser()->getUsername());
        $form = $this->createForm(new RecordBaseType(), $clientRecord);

        $form->handleRequest($request);
        $step = 1;

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clientRecord);
            $entityManager->flush();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'record.basic_saved');

            return $this->redirectToRoute('admin_record_new_health', array(
                        'record_id' => $clientRecord->getId(),
            ));
        }

        return $this->render('admin/record/new.html.twig', array(
                    'record' => $clientRecord,
                    'form' => $form->createView(),
                    'step' => $step
        ));
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/{id}", name="admin_record_delete")
     * @Method("DELETE")
     *
     * The Security annotation value is an expression (if it evaluates to false,
     * the authorization mechanism will prevent the user accessing this resource).
     * The isAuthor() method is defined in the AppBundle\Entity\Post entity.
     */
    public function deleteAction(Request $request, ClientRecord $clientRecord) {
        $form = $this->createDeleteForm($clientRecord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($clientRecord);
            $entityManager->flush();

            $this->addFlash('success', 'record.deleted_successfully');
        }

        return $this->redirectToRoute('admin_record_index');
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
     * @param ClientRecord $record The post object
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ClientRecord $record) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_record_delete', array('id' => $record->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Search all Post entities.
     *
     * This controller responds to two different routes with the same URL:
     *   * 'admin_record_search' is the route with a name that follows the same
     *     structure as the rest of the controllers of this class.
     *   * 'admin_index' is a nice shortcut to the backend homepage. This allows
     *     to create simpler links in the templates. Moreover, in the future we
     *     could move this annotation to any other controller while maintaining
     *     the route name and therefore, without breaking any existing link.
     *
     * @Route("/search", name="admin_record_search")
     * @Method({"GET", "POST"})
     */
    public function searchAction(Request $request) {

        $form = $this->createForm(new RecordSearchType());
        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $clientID = $form->get('clientID')->getData();
            $firstName = $form->get('firstName')->getData();
            $lastName = $form->get('lastName')->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $query = $entityManager->createQuery(
                            'SELECT p
                            FROM AppBundle:ClientRecord p
                            WHERE p.clientID like :client_id
                            OR p.firstName like :first_name
                            OR p.lastName like :last_name
                            ORDER BY p.dateOfCall DESC'
                    )
                    ->setParameter('client_id', '%'.$clientID.'%')
                    ->setParameter('first_name','%'.$firstName.'%')
                    ->setParameter('last_name','%'.$lastName.'%');

            $records = $query->getResult();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'record.search_results');

            return $this->render('admin/record/search.html.twig', array(
                        'records' => $records,
                        'form' => $form->createView(),
            ));
        }

        return $this->render('admin/record/search.html.twig', array(
                    'records' => NULL,
                    'form' => $form->createView(),
        ));
    }

}
