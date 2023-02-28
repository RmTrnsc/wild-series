<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Exception;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{

    /**
     * Undocumented function
     * @Route("/",name="index")
     * @param ProgramRepository $programRepository
     * @return Response
     */
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    /**
     * @Route("/{programId}", methods={"GET"}, name="show")
     * @param $programId
     * @param ProgramRepository $programRepository
     * @return Response
     * @throws Exception
     */
    public function show($programId, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->find($programId);

        return $this->render('program/show.html.twig', [
            'program' => $program
        ]);
    }

    /**
     * @Route("/{programId}/season/{seasonId}", name="season_show")
     * @param int $programId
     * @param int $seasonId
     * @param ProgramRepository $programRepository
     * @param SeasonRepository $seasonRepository
     * @return Response
     */
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season
        ]);
    }
}
