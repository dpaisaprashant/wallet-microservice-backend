<?php

namespace App\Http\Controllers;

// use App\Post;
use Illuminate\Http\Request;
use App\Models\Blog\Post;
use App\Models\Blog\Type;
use App\Models\Blog\Tag;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('types','tags')->get();
        $tags = Tag::all();
        $types = Type::all();
        return view('admin.blog.post', compact('posts', 'tags', 'types'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::with('types','tags')->get();
        $tags = Tag::all();
        $types = Type::all();
        return view('admin.blog.post_form', compact('posts', 'tags', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
             $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'image' => 'required',
            'tag.*' => 'required',
            'type' => 'required',
            'status' => 'required',] ,
            [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'author.required' => 'Author is required',
            'image.required' => 'Image is required',
            'tag.required' => 'Tag is required',
            'type.required' => 'Type is required',
            'status.required' => 'Status is required',
            ]);
        
            $posts = new Post;
            $posts->title = $request->title;
            $posts->description = $request->description;
            $posts->author = $request->author;
            // $posts->image = $request->image;
            $posts->tag = implode(',', $request->tag);            
            $posts->type = $request->type;
            $posts->status = $request->status;
            $posts->slug = Str::slug($request->title);

          if($request->hasFile('image')) {
            
            $fileName = time() . '.'. $request->file('image')->extension();
            $request->file('image')->storeAs('public', $fileName);
            $posts->image = $fileName;
            
          }
        
          $posts->save();
          return redirect('admin/blog/post')
          ->with('success','Post created successfully.');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'author' => 'required',
        // 'image' => 'required',
        'tag.*' => 'required',
        'type' => 'required',
        'status' => 'required',
      ]);

     $posts = Post::find($id);
      if($request->hasFile('image')) {
            $fileName = time() . '.'. $request->file('image')->extension();
            $request->file('image')->storeAs('public', $fileName);
            // $posts->image = $fileName;
           $validated['image'] = $fileName;
            
          }
  
    $validated['tag'] = implode(',', $request->tag);

      Post::find($id)->update($validated);
      return redirect('admin/blog/post')
          ->with('success', 'Post updated successfully');
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $posts = Post::find($id);
      $tags = Tag::all(); // Retrieve all tags from the database
      $types = Type::all();
      return view('admin/blog/edit_post', ['posts' => $posts,'tags' => $tags,'types' => $types]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $posts = Post::find($id);
      $posts->delete();
      return redirect()->back()
        ->with('success', 'Post deleted successfully');
    }


public function changeStatus($id)
   {
    $posts = Post::find($id);
    $posts->status = $posts->status == 'draft' ? 'published' : 'draft';
    $posts->save();
    return back()->with('status', 'Status has been changed');
    }

}