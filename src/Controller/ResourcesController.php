<?php

namespace App\Controller;

use App\Repository\ActivityareaRepository;
use App\Repository\ResourcesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResourcesController extends AbstractController
{
    #[Route('/resources', name: 'all_resource_view')]
    public function getAllResources(ResourcesRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $activityAreas = $repository->findDistinctactivityAreas();

        $pagination = $paginator->paginate(
            $repository->paginationQuery(),
            $request->query->get('page', 1),
            6
        );

        return $this->render('resources/resources.html.twig', [
            'pagination' => $pagination,
            'activityAreas' => $activityAreas,
        ]);
    }

    #[Route('/single-resource/{id}', name: 'single_resource_view')]
    public function getResourcesById($id, ResourcesRepository $repository): Response
    {
        $resource = $repository->find($id);

        return $this->render('resources/single-resource.html.twig', [
            'resource' => $resource,
            'resourceId' => $id,
        ]);
    }

    #[Route('/resources/filtered', name: 'resource_filtered')]
public function filterByActivityArea(Request $request, ResourcesRepository $repository): Response
{
    $activityAreaName = $request->query->get('activityArea');
    $activityAreas = $repository->findDistinctactivityAreas();

    if (!empty($activityAreaName)) {
        $resources = $repository->createQueryBuilder('r')
            ->leftJoin('r.activityarea', 'a')
            ->andWhere('a.activityAreaName = :activityAreaName')
            ->setParameter('activityAreaName', $activityAreaName)
            ->getQuery()
            ->getResult();
    } else {
        $resources = $repository->findAll();
    }

    return $this->render('resources/filter_resources.html.twig', [
        'resources' => $resources,
        'activityAreas' => $activityAreas,
    ]);
}

    #[Route('/resources/search', name: 'resource_search')]
    public function searchResources(Request $request, ResourcesRepository $repository): Response
    {
        $keyword = $request->query->get('keyword');
        $resources = $repository->findByTitleKeyword($keyword);

        return $this->render('resources/result_research.html.twig', [
            'resources' => $resources,
        ]);
    }
}
