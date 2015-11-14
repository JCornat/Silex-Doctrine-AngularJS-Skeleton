<?php

namespace Application\Service;

use Doctrine\ORM\QueryBuilder;
use Application\Controller\AbstractController;
use Application\Entity\Example;
use Application\Repository\ExampleRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class ExampleService extends AbstractController
{
    public function get($id)
    {
        return $this->app->json($id, 200);
    }

    public function add($memberId, $documentId)
    {
        $data = array();

        try {

            if($_SESSION['id'] != $memberId && !isset($_SESSION['admin'])) {
                throw new \Exception("Forbidden");
            }

            $member = $this->em->getRepository('src\Entity\Member')->find($memberId);

            if($member == null) {
                throw new \Exception("Member not found");
            }

            $document = $this->em->getRepository('src\Entity\Document')->find($documentId);
            if($document == null) {
                throw new \Exception("Document not found");
            }

            $dm = $this->em->getRepository('src\Entity\DocumentMember')->findOneBy(array("document" => $document, "member" => $member));

            if($dm != null) {
                throw new \Exception("DocumentMember already exists");
            }

            $documentMember = new DocumentMember();
            $documentMember->setMember($member);
            $documentMember->setDocument($document);
            $this->em->persist($documentMember);
            $this->em->flush();

            $activity = new ActivityController($this->request, $this->app);
            $activity->addActivity($member, $document, 1);

            $data['documents'] = $document->toArray();

        } catch(\Exception $e) {
            $data['message'] = $e->getMessage();
            return $this->app->json($data, 500);
        }

        return $this->app->json($data, 200);
    }

    public function remove($memberId, $documentId)
    {

        $data = array();

        try {

            if($_SESSION['id'] != $memberId && !isset($_SESSION['admin'])) {
                throw new \Exception("Forbidden");
            }

            $member = $this->em->getRepository('src\Entity\Member')->find($memberId);

            if($member == null) {
                throw new \Exception("Member not found");
            }

            $document = $this->em->getRepository('src\Entity\Document')->find($documentId);
            if($document == null) {
                throw new \Exception("Document not found");
            }

            $documentMember = $this->em->getRepository('src\Entity\DocumentMember')->findOneBy(array("document" => $document, "member" => $member));

            if($documentMember == null) {
                throw new \Exception("DocumentMember not found");
            }

            $this->em->remove($documentMember);
            $this->em->flush();

        } catch(\Exception $e) {
            $data['message'] = $e->getMessage();
            return $this->app->json($data, 500);
        }

        return $this->app->json($data, 200);
    }


    public function getMines($memberId)
    {
        $data = array();
        $body = $this->request->getContent();
        $param = json_decode($body);

        try {

            if($_SESSION['id'] != $memberId && !isset($_SESSION['admin'])) {
                throw new \Exception("Forbidden");
            }

            $data['documents'] = [];

            $member = $this->em->getRepository('src\Entity\Member')->find($memberId);

            if($member == null)  {
                throw new \Exception('Member not found');
            }

            $qb = $this->em->createQueryBuilder();

            $qb->select('d')
                ->from('src\Entity\DocumentMember','d')
                ->orderBy('d.createdAt', 'DESC')
                ->where('d.member = ?1')
                ->setParameter(1, $member);

            if(property_exists($param, 'count')) {
                $qb->setMaxResults($param->count);
            } else {
                $qb->setMaxResults(12);
            }

            if(property_exists($param, 'from')) {
                $qb->setFirstResult($param->from);
            }

            $results = $qb->getQuery()->execute();
            foreach ($results as $documentMember) {
                $data['documents'][] = $documentMember->getDocument()->toArray();
            }

            $documentMembers = $this->em->getRepository('src\Entity\DocumentMember')->findBy(array("member" => $member));
            $data['count'] = count($documentMembers);

        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return $this->app->json($data, 500);
        }

        return $this->app->json($data, 200);
    }

    public function getLatestMines($memberId)
    {
        $data = array();

        try {

            if($_SESSION['id'] != $memberId && !isset($_SESSION['admin'])) {
                throw new \Exception("Forbidden");
            }

            $data['documents'] = [];

            $member = $this->em->getRepository('src\Entity\Member')->find($memberId);

            if($member == null)  {
                throw new \Exception('Member not found');
            }

            $qb = $this->em->createQueryBuilder();

            $qb->select('d')
                ->from('src\Entity\DocumentMember','d')
                ->orderBy('d.createdAt', 'DESC')
                ->where('d.member = ?1')
                ->setParameter(1, $member)
                ->setMaxResults(12);

            $results = $qb->getQuery()->execute();
            foreach ($results as $documentMember) {
                $data['documents'][] = $documentMember->getDocument()->toArray();
            }

            $documentMembers = $this->em->getRepository('src\Entity\DocumentMember')->findBy(array("member" => $member));
            $data['count'] = count($documentMembers);

        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return $this->app->json($data, 500);
        }

        return $this->app->json($data, 200);
    }

}
