<?php

namespace App\Http\Controllers;

use OpenGraph;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Like;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class CommentairesController extends Controller
{
    //     public function index()
    // {
    //     $commentaires = Commentaire::all();
    //     return view('Commentaires', compact('commentaires'));
    // }
    
    public function index()
    {
        $commentaires = Commentaire::with('user')->get();

        $commentairesTriés = $commentaires->sortByDesc('id');

        $com_lien = $commentairesTriés->groupBy('url');
        $url_info = [];

        foreach ($com_lien as $url => $comlien) {
            $url_info[$url] = $this->fetchUrlInfo($url);
        }

        return view('Commentaires', compact('com_lien', 'url_info'));
    }

    public function first()
    {
        $commentaires = Commentaire::with('user')->get();

        $commentairesTriés = $commentaires->sortByDesc('id');

        $com_lien = $commentairesTriés->groupBy('url');
        $url_info = [];

        foreach ($com_lien as $url => $comlien) {
            $url_info[$url] = $this->fetchUrlInfo($url);
        }

        return view('welcome', compact('com_lien', 'url_info'));
    }
    public function allcomment()
    {

        $commentaires = Commentaire::with('user')->get();
        $com_lien = $commentaires->groupBy('url');
        $url_info = [];

        foreach ($com_lien as $url => $comlien) {
            $url_info[$url] = $this->fetchUrlInfo($url);
        }

        return view('comment', compact('com_lien', 'url_info'));
    }
    public function commentplus()
    {

        $commentaires = Commentaire::with('user')->get();
        $com_lien = $commentaires->groupBy('url');
        $url_info = [];

        foreach ($com_lien as $url => $comlien) {
            $url_info[$url] = $this->fetchUrlInfo($url);
        }

        return view('commentplus', compact('com_lien', 'url_info'));
    }
    private function fetchUrlInfo($url)
    {
        $client = new Client();
        $response = $client->get($url);

        if ($response->getStatusCode() === 200) {
            $htmlContent = $response->getBody()->getContents();
            $dom = new \DOMDocument();
            @$dom->loadHTML($htmlContent);

            $title = $dom->getElementsByTagName('title')->item(0)->nodeValue;
            $description = ''; // Extract description based on the HTML structure
            $metaTags = $dom->getElementsByTagName('meta');
            foreach ($metaTags as $metaTag) {
                if ($metaTag->getAttribute('name') === 'description') {
                    $description = $metaTag->getAttribute('content');
                    break; // Sortie de la boucle une fois la description trouvée
                }
            }
            $iconUrl = '';
            $linkTags = $dom->getElementsByTagName('link');
            foreach ($linkTags as $linkTag) {
                if (
                    $linkTag->getAttribute('rel') === 'icon' ||
                    $linkTag->getAttribute('rel') === 'shortcut icon'
                ) {
                    $iconUrl = $linkTag->getAttribute('href');
                    break; // Sortie de la boucle une fois l'URL de l'icône trouvée
                }
            }
            return [
                'title' => $title,
                'description' => $description,
                'iconUrl' => $iconUrl,

            ];
        } else {
            return [
                'title' => 'N/A',
                'description' => 'N/A',
                'iconUrl' => 'N/A',

            ];
        }
    }
    public function store(Request $request)
    {
        //session(['id_user' => 3]);
        // $id_user = session('id_user');

        $commentaire = new Commentaire();
        $commentaire->url = $request->input('url');
        $commentaire->id_user = $request->input('id_user');
        //$commentaire->id_user = session('id_user');
        $commentaire->commentaire = $request->input('commentaire');

        $commentaire->save();

        return redirect()->route('commentaires');
    }

    public function destroy($id)
{
    $commentaire = Commentaire::find($id);

    if (!$commentaire) {
        return response()->json(['error' => 'Commentaire non trouvé'], 404);
    }
    // Vérifier si l'utilisateur est autorisé à supprimer le commentaire
    // if ($commentaire->id_user != session('utilisateur')->id) {
    //     return response()->json(['error' => 'Vous n\'êtes pas autorisé à supprimer ce commentaire'], 403);
    // }

    // Supprimer le commentaire
    $commentaire->delete();

    // return response()->json(['message' => 'Commentaire supprimé avec succès']);
    return redirect()->route('commentaires');
}
    public function storeComment(Request $request, $id)
    {
        // Validation des champs du formulaire
        $request->validate([
            'url' => 'required|url',
            'id_user' => 'required|integer',
            'commentaire' => 'required|string',
        ]);

        $commentaire = new Commentaire();
        $commentaire->url = $request->input('url');
        $commentaire->id_user = $request->input('id_user');
        $commentaire->commentaire = $request->input('commentaire');
        $commentaire->save();

        return redirect()->route('commentaires');
    }

    public function showUserComments($userId)
    {
        $user = User::find($userId);
        $commentaires = Commentaire::where('id_user', $userId)->get();
        $commentairesTriés = $commentaires->sortByDesc('id');
        $com_lien = $commentairesTriés->groupBy('url');
        $url_info = [];

        foreach ($com_lien as $url => $comlien) {
            $url_info[$url] = $this->fetchUrlInfo($url);
        }

        return view('solocomment', compact('user', 'com_lien', 'url_info'));
    }
    public function show($url)
    {
        $commentaires = Commentaire::with('user')->where('url', $url)->get();
        return view('show', compact('commentaires'));
    }
    public function editSolo($id)
    {
        $commentaire = Commentaire::find($id);
        return view('editsolo', compact('commentaire'));
    }
    public function addcomment($id)
    {
        $commentaire = Commentaire::find($id);
        return view('addcomment', compact('commentaire'));
    }

    public function update(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'commentaire' => 'string',
        ]);
        $commentaire = Commentaire::find($request->id);
        $commentaire->commentaire = $request->commentaire;
        $commentaire->update();

        $commentaires = Commentaire::with('user')->get();
        $com_lien = $commentaires->groupBy('url');
        $url_info = [];

        foreach ($com_lien as $url => $comlien) {
            $url_info[$url] = $this->fetchUrlInfo($url);
        }

        foreach ($com_lien as $url => $comlien) {
            $url_info[$url] = $this->fetchUrlInfo($url);
        }

        return view('Commentaires', compact('com_lien', 'url_info'));
    }

    public function likeCommentaire(Request $request, $id)
{   
    // $id_user = \Illuminate\Support\Facades\Session::get('id_user');
    $id_user = session('utilisateur')->id;
    $commentaire = Commentaire::findOrfail($id);

    $like = Like::where('id_commentaire', $commentaire->id)
                ->where('id_user', $id_user)
                ->first();

    if($like){
        $like->delete();
    }
    else {
        $newlike = new Like();
        $newlike->id_commentaire = $commentaire->id;
        $newlike->id_user = $id_user;
        $newlike->like = true;  //pour spécifier que c'est un like
        $newlike->save();
    }
    return redirect()->back();
        
    }

    public function showAll($encodedUrl)
    {
        $url = base64_decode($encodedUrl);
        $commentaires = Commentaire::where('url', $url)->with('user')->get();
        $url_info = $this->fetchUrlInfo($url);

        return view('show', compact('commentaires', 'url_info'));
    }
}
