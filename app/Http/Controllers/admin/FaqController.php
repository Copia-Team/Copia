<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function show(){
        $search = request('search');
        $page = request('page', 1);

        $faqs = Faq::query();

        if ($search) {
            $faqs->search($search);
        }

        $faqs = $faqs->paginate(5, ['*'], 'page', $page);

        return view('admin.faq.faq',[
            'faqs' => $faqs
        ]);
    }

    public function delete($id){
        $faq = Faq::find($id);

        if (!$faq) {
            return redirect()->route('faq.faq')->with('failed', 'Failed deleted faq.');
        }

        $faq->delete();
        return redirect()->route('faq.faq')->with('success', 'faq successfully deleted.');
    }
}
