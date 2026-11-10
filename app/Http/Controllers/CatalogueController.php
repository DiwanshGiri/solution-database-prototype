<?php
namespace App\Http\Controllers;

use App\Models\{Offer, Problem, Solution, Tag};
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $problems = Problem::with('solutions')->orderBy('name')->get();
        $solutions = Solution::with('problems')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $selectedProblem = $request->integer('problem');
        $selectedSolution = $request->integer('solution');
        $availableSolutions = $selectedProblem ? Problem::find($selectedProblem)?->solutions()->orderBy('name')->get() ?? collect() : $solutions;

        $allOffers = Offer::with(['solutions','tags'])->orderBy('name')->get();
        $offers = collect();
        if ($selectedSolution) {
            $offers = Offer::with('tags')->whereHas('solutions', fn($q) => $q->where('solutions.id', $selectedSolution))->orderBy('name')->get();
        }
        return view('catalogue.index', compact('problems','solutions','tags','selectedProblem','selectedSolution','availableSolutions','offers','allOffers'));
    }

    public function storeProblem(Request $request) { Problem::create($request->validate(['name'=>'required|max:255','description'=>'nullable'])); return back()->with('success','Problem added.'); }
    public function updateProblem(Request $request, Problem $problem) { $problem->update($request->validate(['name'=>'required|max:255','description'=>'nullable'])); return back()->with('success','Problem updated.'); }
    public function destroyProblem(Problem $problem) { $name = $problem->name; $problem->delete(); return back()->with('success', 'Problem “'.$name.'” removed. Linked solutions and offers were kept.'); }
    public function storeSolution(Request $request) { $data=$request->validate(['name'=>'required|max:255','description'=>'nullable','problem_ids'=>'required|array','problem_ids.*'=>'exists:problems,id']); $solution=Solution::create($data); $solution->problems()->sync($data['problem_ids']); return back()->with('success','Solution added.'); }
    public function updateSolution(Request $request, Solution $solution) { $data=$request->validate(['name'=>'required|max:255','description'=>'nullable','problem_ids'=>'required|array','problem_ids.*'=>'exists:problems,id']); $solution->update($data); $solution->problems()->sync($data['problem_ids']); return back()->with('success','Solution updated.'); }
    public function destroySolution(Solution $solution) { $solution->delete(); return back()->with('success','Solution removed. Linked offers were kept.'); }
    public function storeOffer(Request $request) { $data=$request->validate(['name'=>'required|max:255','type'=>'required|in:product,service,approach','description'=>'nullable','url'=>'nullable|url','solution_ids'=>'required|array','solution_ids.*'=>'exists:solutions,id','tags'=>'nullable|string']); $offer=Offer::create($data); $offer->solutions()->sync($data['solution_ids']); $this->syncTags($offer, $data['tags'] ?? ''); return back()->with('success','Product or service added.'); }
    public function updateOffer(Request $request, Offer $offer) { $data=$request->validate(['name'=>'required|max:255','type'=>'required|in:product,service,approach','description'=>'nullable','url'=>'nullable|url','solution_ids'=>'required|array','solution_ids.*'=>'exists:solutions,id','tags'=>'nullable|string']); $offer->update($data); $offer->solutions()->sync($data['solution_ids']); $this->syncTags($offer, $data['tags'] ?? ''); return back()->with('success','Product or service updated.'); }
    public function destroyOffer(Offer $offer) { $offer->delete(); return back()->with('success','Product or service removed.'); }
    private function syncTags(Offer $offer, string $tags): void { $ids=collect(explode(',', $tags))->map(fn($tag)=>trim($tag))->filter()->map(fn($tag)=>Tag::firstOrCreate(['name'=>$tag])->id); $offer->tags()->sync($ids); }
}
