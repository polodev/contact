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
        $contacts = Contact::orderBy('id', 'desc')->paginate(3);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate(request(), [
            'name' => 'required',
            "username" => 'required',
            "mobile" => 'required',
        ]);
        $slug = str_slug($request->username);
        $latestSlug = Contact::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
                        ->latest('id')
                        ->limit(1)
                        ->pluck('slug');
        // return ['slug' => $latestSlug];
        if (count($latestSlug) != 0) {
          $pieces = explode('-', $latestSlug);
          $number = intval( end($pieces) );
          $slug = $slug . '-' . ($number + 1);
        }
        $avatar = 'public/avatars/default/female.png';
        if (intval(request('gender'))) {
            $avatar = 'public/avatars/default/male.png';
        }
        if (request('avatar')) {
            $data = request('avatar');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'.png';
            $path = storage_path('app/public/avatars/');
            if(!file_exists($path)) {
              mkdir($path, 0755, true);
            }
            file_put_contents($path . $imageName, $data);
            $avatar ='avatars/' . $imageName;
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
            'about' => request('about'),
        ]);
         return ['message' => 'Contact Created'];
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
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $contact = Contact::where('slug', $slug)->firstOrFail();
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {

         $this->validate(request(), [
            'name' => 'required',
            "username" => 'required',
            "mobile" => 'required',
        ]);
        $contact = Contact::where('slug', $slug)->firstOrFail();
        $avatar = $contact->avatar;
        if (request('avatar')) {
            unlink('app/public/' . $avatar);
            $data = request('avatar');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'.png';
            $path = storage_path('app/public/avatars/');
            if(!file_exists($path)) {
              mkdir($path, 0755, true);
            }
            file_put_contents($path . $imageName, $data);
            $avatar ='avatars/' . $imageName;
        }
       Contact::where('slug', $slug)
         ->update([
              'name' => request('name'),
              'username' => request('username'),
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
              'about' => request('about'),
          ]);
         return ['message' => 'Contact updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $contact = Contact::where('slug', $slug)->firstOrFail();
        $contact->delete();
        return redirect('/');
    }
}
