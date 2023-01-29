<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContactFormRequest​;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function create(): Response
    {
        return response()->view('contact');
    }

    public function store(ContactFormRequest​ $request): RedirectResponse
    {
        // get validated form data
        $validatedData = $request->validated();
        
        return response()
            ->redirectToRoute('contact')   // redirect user to GET /contact-us page
            ->withErrors($request)            // pass all validation errors  
            ->withInput();                    // pass form data 
    }
    public function create2()
    {
        return view('contact2');
    }

    function store2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'title' => 'required|unique:posts|max:255',
        ]);

        if ($validator->fails()) {

            // redirect back to post create page
            // with submitted form data
            return redirect('contact2')
                ->withErrors($validator)
                ->withInput();
        }

        // store your post data
    }
}
