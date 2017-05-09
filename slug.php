<?php 
///method 1
$index = 1;
while (Post::whereSlug($post->slug)->exists()) {
  $post->slug = str_slug($request->title) . '-' . $index++;
}

//method 2 (wrong)
$count = Post::whereRaw("slug RLIKE '^{$post->slug}(-[0-9]*)?$'")->count();
$post->slug = $count ? "{$post->slug}-{$count}" : $post->slug;

//method 3
$slug = str_slug($request->title);
$latestSlug = Post::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
                ->latest('id')
                ->pluck('slug');
if ($latestSlug) {
  $pieces = explode('-', $latestSlug);
  $number = end($pieces);
  $slug = $slug . '-' . ($number + 1);
}
