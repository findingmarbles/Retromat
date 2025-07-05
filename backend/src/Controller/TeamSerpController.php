<?php

namespace App\Controller;

use App\Model\Plan\DescriptionRenderer;
use App\Model\Plan\Exception\InconsistentInputException;
use App\Model\Plan\TitleChooser;
use App\Model\Plan\TitleIdGenerator;
use App\Model\Sitemap\PlanIdGenerator;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale}/team')]
class TeamSerpController extends AbstractController
{
    private array $planIds = [];
    private PlanIdGenerator $planIdGenerator;
    private TitleChooser $titleChooser;
    private DescriptionRenderer $descriptionRenderer;
    private ActivityRepository $activityRepository;
    private TitleIdGenerator $titleIdGenerator;

    public function __construct(
        PlanIdGenerator $planIdGenerator,
        TitleChooser $titleChooser,
        DescriptionRenderer $descriptionRenderer,
        ActivityRepository $activityRepository,
        TitleIdGenerator $titleIdGenerator,
    ) {
        $this->planIdGenerator = $planIdGenerator;
        $this->titleChooser = $titleChooser;
        $this->descriptionRenderer = $descriptionRenderer;
        $this->activityRepository = $activityRepository;
        $this->titleIdGenerator = $titleIdGenerator;
    }

    /**
     * @throws InconsistentInputException
     */
    #[Route('/team/serp/preview', name: 'team_serp_preview')]
    public function preview(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SERP_PREVIEW');

        $this->planIdGenerator->generate([$this, 'pushPlanId'], (int) $request->get('max'), (int) $request->get('skip'));
        $totalCombinations = $this->titleIdGenerator->countCombinationsInAllSequences(
            $request->getLocale()
        );

        return $this->render('team/serp/preview.html.twig', [
            'planIds' => $this->planIds,
            'titleChooser' => $this->titleChooser,
            'descriptionRenderer' => $this->descriptionRenderer,
            'totalCombinations' => $totalCombinations,
            'activityRepository' => $this->activityRepository,
        ]);
    }

    public function pushPlanId(string $id): void
    {
        $this->planIds[] = $id;
    }
}
