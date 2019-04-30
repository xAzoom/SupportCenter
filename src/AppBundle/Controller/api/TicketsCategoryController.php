<?php

namespace AppBundle\Controller\api;

use AppBundle\Form\CreateTicketsCategoryForm;
use AppBundle\Service\CreateTicketsCategory;
use AppBundle\Service\InputValidator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class TicketsCategoryController extends Controller
{
    /**
     * @Route("/api/categories", methods={"POST"})
     */
    public function createAction(Request $request, InputValidator $inputValidator, CreateTicketsCategory $createTicketsCategory)
    {
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            throw new HttpException(404, 'Bad format json');
        }

        $form = $this->createForm(CreateTicketsCategoryForm::class);
        $form->submit($data);

        if ($form->isSubmitted() && !$form->isValid()) {
            // TODO throw ApiProblem
            return new JsonResponse($this->getErrorsFromForm($form), 400);
        }

        if (!array_key_exists('inputs', $data) || !$inputValidator->areValidInputs($data['inputs'])) {
            // TODO throw ApiProblem
            throw new HttpException(400, 'Invalid inputs');
        }

        $createTicketsCategory->create($data);

        return new JsonResponse('OK', 201);
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}