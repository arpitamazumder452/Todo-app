<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = session()->get('todos', []);

        return view('dashboard', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todos = session()->get('todos', []);
        $todos[] = ['title' => $request->title, 'completed' => false];
        session(['todos' => $todos]);

        return redirect()->route('dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todos = session()->get('todos', []);
        if (isset($todos[$id])) {
            $todos[$id]['title'] = $request->title;
            $todos[$id]['completed'] = $request->has('completed');
            session(['todos' => $todos]);
        }

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $todos = session()->get('todos', []);
        if (isset($todos[$id])) {
            unset($todos[$id]);
            session(['todos' => $todos]);
        }

        return redirect()->route('dashboard');
    }
}
