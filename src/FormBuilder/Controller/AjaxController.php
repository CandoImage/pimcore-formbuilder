<?php

namespace FormBuilderBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends FrontendController
{
    /**
     * @param Request $request
     */
    public function parseAction(Request $request)
    {
        throw new \RuntimeException('form parse action gets handled by kernel events.');
    }

    public function fileAddAction(Request $request)
    {
        $method = $request->getMethod();

        $formId = $request->request->get('formId');
        $fieldName = $request->request->get('fieldName');

        /** @var \Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag $sessionBag */
        $sessionBag = $this->container->get('session')->getBag('form_builder_session');
        $fileStream = $this->container->get('form_builder.stream.file');

        if ($method === 'POST') {
            $result = $fileStream->handleUpload();
            $result['uploadName'] = $fileStream->getRealFileName();

            if ($result['success'] === TRUE) {
                $sessionKey = 'file_' . $formId . '_' . $result['uuid'];
                $sessionValue = ['fileName' => $result['uploadName'], 'fieldName' => $fieldName, 'uuid' => $result['uuid']];
                $sessionBag->set($sessionKey, $sessionValue);
            }

            return $this->json($result);

        } else if ($method === 'DELETE') {
            return $this->fileDeleteAction($request, $request->request->get('uuid'));
        } else {
            $response = new Response();
            $response->headers->set('Content-Type', 'text/plain');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->setStatusCode(405);
            return $response;
        }
    }

    /**
     * @param Request $request
     * @param string $uuid
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function fileDeleteAction(Request $request, $uuid = '')
    {
        $formId = $request->request->get('formId');

        /** @var \Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag $sessionBag */
        $sessionBag = $this->container->get('session')->getBag('form_builder_session');
        $fileStream = $this->container->get('form_builder.stream.file');

        //remove tmp element from session!
        $sessionKey = 'file_' . $formId . '_' . $uuid;
        $sessionBag->remove($sessionKey);

        $result = $fileStream->handleDelete($uuid);

        return $this->json($result);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function fileChunkDoneAction(Request $request)
    {
        $formId = $request->request->get('formId');
        $fieldName = $request->request->get('fieldName');

        /** @var \Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag $sessionBag */
        $sessionBag = $this->container->get('session')->getBag('form_builder_session');
        $fileStream = $this->container->get('form_builder.stream.file');

        $result = $fileStream->combineChunks();

        // To return a name used for uploaded file you can use the following line.
        $result['uploadName'] = $fileStream->getRealFileName();

        if ($result['success'] === TRUE) {
            //add uuid to session to find it again later!
            $sessionKey = 'file_' . $formId . '_' . $result['uuid'];
            $sessionValue = ['fileName' => $result['uploadName'], 'fieldName' => $fieldName, 'uuid' => $result['uuid']];
            $sessionBag->set($sessionKey, $sessionValue);
        }

        return $this->json($result, $result['statusCode']);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getAjaxUrlStructureAction(Request $request)
    {
        $router = $this->container->get('router');

        return $this->json([
            'form_parser'     => $router->generate('form_builder.controller.ajax.parse_form'),
            'file_chunk_done' => $router->generate('form_builder.controller.ajax.file_chunk_done'),
            'file_add'        => $router->generate('form_builder.controller.ajax.file_add'),
            'file_delete'     => $router->generate('form_builder.controller.ajax.file_delete'),
        ]);
    }
}