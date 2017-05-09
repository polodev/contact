<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = str_slug($request->username);
        $latestSlug = Contact::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
                        ->latest('id')
                        ->pluck('slug');
        if (empty($latestSlug)) {
          $pieces = explode('-', $latestSlug);
          $number = end($pieces);
          $slug = $slug . '-' . ($number + 1);
        }

        $avatar = 'public/avatars/default/female.png';
        if (intval(request('gender'))) {
            $avatar = 'public/avatars/default/male.png';
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar->store('public/avatars');
        }
        Contact::create([
            'user_id' => auth()->id(),
            'name' => request('name'),
            'username' => request('username'),
            'slug' => $slug,
            'avatar' => $avatar,
            'gender' => request('gender'),
            'city' => request('city'),
            'relation' => request('relation'),
            'address' => request('address'),
            'designation' => request('designation'),
            'mobile' => request('mobile'),
            'email' => request('email'),
            'facebook' => request('facebook'),
            'twitter' => request('twitter'),
            'linkedin' => request('linkedin'),
            'mnemonics' => request('mnemonics'),
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $contact = Contact::where('slug', $slug)->firstOrFail();
        return view('contacts.profile', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
