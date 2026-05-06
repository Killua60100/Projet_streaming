<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    // Récupérer les commentaires d'un film
    public function getComments($imdbId)
    {
        $comments = Comment::where('imdb_id', $imdbId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($comments);
    }

    // Créer un commentaire
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'imdb_id' => 'required|string',
                'content' => 'required|string|min:1|max:1000',
            ]);

            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Authentication required',
                ], 401);
            }

            $comment = Comment::create([
                'user_id' => auth()->id(),
                'imdb_id' => $validated['imdb_id'],
                'content' => $validated['content'],
            ]);

            return response()->json([
                'success' => true,
                'comment' => $comment->load('user'),
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Mettre à jour un commentaire
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'content' => 'required|string|min:1|max:1000',
        ]);

        $comment->update($validated);

        return response()->json([
            'success' => true,
            'comment' => $comment->load('user'),
        ]);
    }

    // Supprimer un commentaire
    public function destroy(Comment $comment)
    {
        $user = auth()->user();
        if ($comment->user_id !== auth()->id() && !$user->is_admin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $comment->delete();

        return response()->json(['success' => true]);
    }
}
