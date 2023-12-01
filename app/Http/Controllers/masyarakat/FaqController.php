<?php

namespace App\Http\Controllers\masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faq(Request $request){
        $filter = $request->input('filter');

        $faqsQuery = Faq::where('status', true);

        if ($filter) {
            $faqsQuery->whereHas('category', function ($query) use ($filter) {
                $query->where('category', $filter);
            });
        }

        $perPage = 5;
        $faqs = $faqsQuery->paginate($perPage);
        $categories = Category::all();

        return view('masyarakat.faq',[
            'faqs' => $faqs,
            'categories' => $categories
        ]);
    }

    public function submitFaq(Request $request)
{
    $data = $request->validate([
        'question' => 'required|string|max:255',
    ]);

    Faq::create($data);

    return redirect()->route('faq')->with('success', 'Question submitted successfully');
}


}
