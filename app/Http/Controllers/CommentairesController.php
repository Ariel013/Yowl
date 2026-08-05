<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Like;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CommentairesController extends Controller
{
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

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:2048',
            'commentaire' => 'required|string|max:1000',
        ]);

        /** @var User $sessionUser */
        $sessionUser = session('utilisateur');

        $commentaire = new Commentaire();
        $commentaire->url = $request->input('url');
        $commentaire->id_user = $sessionUser->id;
        $commentaire->commentaire = $request->input('commentaire');
        $commentaire->save();

        return redirect()->route('commentaires');
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::find($id);

        if (!$commentaire) {
            return redirect()->route('commentaires')->with('error', 'Commentaire non trouvé.');
        }

        /** @var User $user */
        $user = session('utilisateur');
        if ($commentaire->id_user != $user->id && $user->isadmin != 1) {
            return redirect()->route('commentaires')->with('error', 'Action non autorisée.');
        }

        $commentaire->delete();

        return redirect()->route('commentaires');
    }

    public function edit($id)
    {
        $commentaire = Commentaire::find($id);
        return view('edit', compact('commentaire'));
    }

    public function editSolo($id)
    {
        $commentaire = Commentaire::find($id);
        return view('editsolo', compact('commentaire'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'commentaire' => 'required|string|max:1000',
        ]);

        $commentaire = Commentaire::findOrFail($id);

        /** @var User $user */
        $user = session('utilisateur');
        if ($commentaire->id_user != $user->id && $user->isadmin != 1) {
            return redirect()->route('commentaires')->with('error', 'Action non autorisée.');
        }

        $commentaire->commentaire = $request->input('commentaire');
        $commentaire->save();

        return redirect()->route('commentaires');
    }

    public function likeCommentaire(Request $request, $id)
    {
        /** @var User $sessionUser */
        $sessionUser = session('utilisateur');
        $id_user = $sessionUser->id;
        $commentaire = Commentaire::findOrFail($id);

        $like = Like::where('id_commentaire', $commentaire->id)
                    ->where('id_user', $id_user)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'id_commentaire' => $commentaire->id,
                'id_user' => $id_user,
                'like' => 1,
            ]);
        }

        return redirect()->back();
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

    public function showAll($encodedUrl)
    {
        $url = base64_decode($encodedUrl);
        $commentaires = Commentaire::where('url', $url)->with('user')->get();
        $url_info = $this->fetchUrlInfo($url);

        return view('show', compact('commentaires', 'url_info'));
    }

    public function addComment($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        return view('addcomment', compact('commentaire'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        /** @var User $sessionUser */
        $sessionUser = session('utilisateur');

        Comment::create([
            'id_user' => $sessionUser->id,
            'id_commentaire' => $id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('commentaires');
    }

    private function fetchUrlInfo(string $url): array
    {
        try {
            $client = new Client(['timeout' => 5, 'connect_timeout' => 3]);
            $response = $client->get($url);

            if ($response->getStatusCode() !== 200) {
                return $this->emptyUrlInfo();
            }

            $htmlContent = $response->getBody()->getContents();
            $dom = new \DOMDocument();
            @$dom->loadHTML($htmlContent);

            $titleNode = $dom->getElementsByTagName('title')->item(0);
            $title = $titleNode ? $titleNode->nodeValue : '';

            $description = '';
            $iconUrl = '';

            foreach ($dom->getElementsByTagName('meta') as $meta) {
                if (!$meta instanceof \DOMElement) continue;
                if ($meta->getAttribute('name') === 'description') {
                    $description = $meta->getAttribute('content');
                    break;
                }
            }

            foreach ($dom->getElementsByTagName('link') as $link) {
                if (!$link instanceof \DOMElement) continue;
                $rel = $link->getAttribute('rel');
                if ($rel === 'icon' || $rel === 'shortcut icon') {
                    $iconUrl = $link->getAttribute('href');
                    break;
                }
            }

            return compact('title', 'description', 'iconUrl');
        } catch (RequestException $e) {
            return $this->emptyUrlInfo();
        } catch (\Exception $e) {
            return $this->emptyUrlInfo();
        }
    }

    private function emptyUrlInfo(): array
    {
        return ['title' => '', 'description' => '', 'iconUrl' => ''];
    }
}
