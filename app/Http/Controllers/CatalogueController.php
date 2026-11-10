<?php
namespace App\Http\Controllers;

use App\Models\{Offer, Problem, Solution, Tag};
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $problems = Problem::with('solutions')->orderBy('name')->get();
        $solutions = Solution::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $selectedProblem = $request->integer('problem');
        $selectedSolution = $request->integer('solution');
        $availableSolutions = $selectedProblem ? Problem::find($selectedProblem)?->solutions()->orderBy('name')->get() ?? collect() : $solutions;

        $offers = collect();
        if ($selectedSolution) {
            $offers = Offer::with('tags')->whereHas('solutions', fn($q) => $q->where('solutions.id', $selectedSolution))->orderBy('name')->get();
        }
        return view('catalogue.index', compact('problems','solutions','tags','selectedProblem','selectedSolution','availableSolutions','offers'));
    }

    public function storeProblem(Request $request) { Problem::create($request->validate(['name'=>'required|max:255','description'=>'nullable'])); return back()->with('success','Problem added.'); }
    public function updateProblem(Request $request, Problem $problem) { $problem->update($request->validate(['name'=>'required|max:255','description'=>'nullable'])); return back()->with('success','Problem updated.'); }
    public function destroyProblem(Problem $problem) { $name = $problem->name; $problem->delete(); return back()->with('success', 'Problem “'.$name.'” removed. Linked solutions and offers were kept.'); }
}
