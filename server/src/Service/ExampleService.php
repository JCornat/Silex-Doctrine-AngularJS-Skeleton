<?php

namespace Application\Service;

use Doctrine\ORM\QueryBuilder;
use Application\Controller\AbstractController;
use Application\Entity\ExampleEntity;
use Application\Repository\ExampleRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class ExampleService extends AbstractController
{
    public function get($id)
    {
        /** @var ExampleEntity $example */
        $example = $this->em->getRepository('Application\Entity\ExampleEntity')->find($id);

        if($example == null) {
            throw new \Exception("Example not found");
        }
        $data['data'] = $example->toArray();
        return $this->app->json($data, 200);
    }

    public function add($id)
    {
        $data = array();

        try {

            if($_SESSION['id'] != $id) {
                throw new \Exception("Forbidden");
            }

            $example = $this->em->getRepository('src\Entity\Member')->find($id);

            if($example == null) {
                throw new \Exception("Example not found");
            }
/*
            $document = $this->em->getRepository('src\Entity\Document')->find($documentId);
            if($document == null) {
                throw new \Exception("Document not found");
            }

            $dm = $this->em->getRepository('src\Entity\DocumentMember')->findOneBy(array("document" => $document, "member" => $example));

            if($dm != null) {
                throw new \Exception("DocumentMember already exists");
            }

            $documentMember = new DocumentMember();
            $documentMember->setMember($example);
            $documentMember->setDocument($document);
            $this->em->persist($documentMember);
            $this->em->flush();

            $activity = new ActivityController($this->request, $this->app);
            $activity->addActivity($example, $document, 1);*/

            $data['example'] = $example->toArray();

        } catch(\Exception $e) {
            $data['message'] = $e->getMessage();
            return $this->app->json($data, 500);
        }

        return $this->app->json($data, 200);
    }

}
