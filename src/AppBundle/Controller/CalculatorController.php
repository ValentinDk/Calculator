<?php

namespace AppBundle\Controller;

use AppBundle\Form\CalculatorType;
use AppBundle\Form\ConfirmationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculatorController extends Controller
{
    private const MATERIAL = 'skin';
    private const TEXTURE1 = 'satin';
    private const TEXTURE2 = 'gloss';

    /**
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function indexAction(Request $request): ?Response
    {
        $calculator = [];

        $form = $this->createForm(CalculatorType::class, $calculator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $materialPrice = 0;

            if ($data['material'] === self::MATERIAL) {
                $materialPrice += 10;
            } else {
                $materialPrice += 20;
            }

            if ($data['texture'] === self::TEXTURE1) {
                $materialPrice += 5;
            } elseif ($data['texture'] === self::TEXTURE2) {
                $materialPrice += 15;
            } else {
                $materialPrice += 10;
            }

            $count = $materialPrice * $data['length'] * $data['width'];
            $count += $data['ceilingLevel'] * 10;
            $count += $data['light'] * 5;

            return $this->redirectToRoute('total', ['count' => $count]);
        }

        return $this->render('calculator/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @param float $count
     * @return Response
     */
    public function totalAction(Request $request, float $count): Response
    {
        $mailer = $this->get('mailer');

        $user = [];

        $form = $this->createForm(ConfirmationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = $mailer->createMessage()
                ->setSubject('Новый заказ')
                ->setFrom($data['email'])
                ->setTo('tarasenok2012@mail.ru')
                ->setBody(
                    $this->renderView(
                        'calculator/email.html.twig',
                        [
                            'total' => $count,
                            'form' => $form->createView()
                        ]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirectToRoute('calculator');
        }

        return $this->render('calculator/email.html.twig',
            [
                'total' => $count,
                'form' => $form->createView()
            ]
        );
    }
}
