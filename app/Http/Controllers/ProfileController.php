<?php

namespace App\Http\Controllers;

use App\Models\ConvertedForm;  // <-- Add this line to import the model
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $convertedForms = ConvertedForm::where('user_id', Auth::id())->get();

        return view('profile', compact('convertedForms'));
    }

    public function previewDocx($id)
    {
        $form = ConvertedForm::findOrFail($id);
        $path = storage_path('app/public/' . $form->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->file($path);
    }

    public function index()
    {
        // Retrieve the list of forms converted by the logged-in user
        $convertedForms = ConvertedForm::where('user_id', Auth::id())->get();

        // Pass the forms to the profile view
        return view('profile', ['convertedForms' => $convertedForms]);
    }
}

