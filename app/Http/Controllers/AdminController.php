<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Admin;
use App\Models\EmploiFiliere;


class AdminController extends Controller
{

    public function index(){
        return view('admin.index');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $admin = DB::table('admins')->where('email', $request->email)->first();

        if ($admin && $request->password === $admin->password) {
            // Login successful, store admin information in the session
            $request->session()->put('admin_id', $admin->id);
            $request->session()->put('admin_name', $admin->name); // Store the admin's name
            $request->session()->put('admin_email', $admin->email);

            // Redirect to admin dashboard
            return redirect()->route('etudiant.show');
        }

        // Authentication failed
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function AddEnseignant(){
        return view('enseignant.create');
    }
    public function StoreEnseignant(request $request){
        $valide = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignant,email',
            'password' => 'required|string',
            'matiere' => 'required|string|max:255'
        ]);
        Enseignant::create($valide);
        return redirect()->route('admin.index')->with('success', 'Enseignant cree avec success');
    }

    public function AddEtudiant(){
        return view('Etudiant.create');
    }
    public function StoreEtudiant(request $request){
        $valide=$request->validate([
            'name' => 'required|string|max:255',
            'filiere' =>'required|string|max:255',
            'email' => 'required|email|unique:etudiant,email',
            'password' => 'required|string'
        ]);
        Etudiant::create($valide);
        return redirect()->route('admin.index')->with('success', 'Etudiant cree avec success');
    }

    public function AddSeance(){
        return view('emploi.createfiliere');
    }
    public function StoreSeance(request $request){
        $valide=$request->validate([
            'filiere' => 'required',
            'jour_semaine' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'id_salle' => 'required',
            'id_enseignant' => 'required',
            'matiere' => 'required'
        ]);
        EmploiFiliere::create($valide);
        return redirect()->route('admin.index')->with('success', 'Séance créée avec succès');
    }
}
