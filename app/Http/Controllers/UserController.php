<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;  
use App\Models\Post;
use App\Models\PostViewAnalytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // ← add this
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:8'
        ]);
        $incomingFields['TransPassword'] = $incomingFields['password'];
        $incomingFields['password'] = Hash::make($incomingFields['password']);  

        $user = User::create($incomingFields);
        Auth::login($user);
        return redirect('/');
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'login_email' => ['required', 'email'],
            'login_password' => 'required'
        ]);
        if(Auth::attempt([
            'email' => $incomingFields['login_email'], 
            'password' => $incomingFields['login_password']
        ])){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors(['login_email' => 'Invalid Credentials'])->onlyInput('login_email');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function Explore(){
        $posts = Post::with(['categories', 'tags', 'comments', 'user', 'media'])
                    ->where('status', 'published')
                    ->where('visibility', 'public')
                    ->latest('published_at')
                    ->paginate(100);    
        return view('explore', compact('posts'));
    }

    public function Read(Request $request, string $slug){
        $posts = Post::with(['categories', 'tags', 'comments', 'user', 'media'])
                    ->where('status', 'published')
                    ->where('visibility', 'public')
                    ->where('slug', $slug)
                    ->latest('publish_date')
                    ->firstOrFail();    
        
        if ($posts->table_of_contents) {
            $posts->body = preg_replace_callback(
                '/<h([1-3])([^>]*)>(.*?)<\/h[1-3]>/i',
                function ($m) {
                    $id = Str::slug(strip_tags($m[3]));
                    return "<h{$m[1]}{$m[2]} id=\"{$id}\">{$m[3]}</h{$m[1]}>";
                },
                $posts->body
            );
        }

        $ip = $request->ip();
        $today = now()->toDateString();
        $alreadyViewed = PostViewAnalytics::where('Fk_postId', $posts->id)
                                ->where('ip_address', $ip)
                                ->where('viewed_at', $today)
                                ->exists();
        if (!$alreadyViewed) {
            $posts->increment('views');
            PostViewAnalytics::create([
                'Fk_postId'  => $posts->id,
                'ip_address' => $ip,
                'viewed_at'  => $today,
            ]);
        }       
        
        return view('read', compact('posts'));
    }
}