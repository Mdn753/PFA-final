<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\EmploiFiliere;




class EtudiantController extends Controller
{
    //
    public function allEtudiants(){
        $etudiants = Etudiant::all();

        $adminName = Session::get('admin_name');

        return view('admin.Etudiants',['etudiants'=> $etudiants, 'adminName' => $adminName]);
    }
    public function store(Request $request){
        $validatedData=$request->validate([
            'name'=>'required',
            'filiere'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        Etudiant::create($validatedData);
        return redirect()->route('etudiant.show');
    }


    public function update(Request $request, $id) {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'filiere' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string', 
        ]);

        // Find the student by ID
        $etudiant = Etudiant::findOrFail($id);

        // Update the student's details
        $etudiant->name = $request->name;
        $etudiant->filiere = $request->filiere;
        $etudiant->email = $request->email;
        $etudiant->password = $request->password; 

        // Save the updated student details
        $etudiant->save();

        // Return a response
        return response()->json(['success' => 'Student updated successfully']);
    }


    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $etudiant = DB::table('etudiant')->where('email', $request->email)->first();

        if ($etudiant && $request->password === $etudiant->password) {
            // Login successful, store admin information in the session
            $request->session()->put('etudiant_id', $etudiant->id);
            $request->session()->put('etudiant_name', $etudiant->name);
            $request->session()->put('etudiant_filiere', $etudiant->filiere); // Store the admin's name
            $request->session()->put('etudiant_email', $etudiant->email);
            $request->session()->put('etudiant_password', $etudiant->password);

            // Redirect to admin dashboard
            return redirect()->route('Dashboard.etudiant');
        }

        // Authentication failed
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function Dashboard(){
        $etudiantId = Session::get('etudiant_id');
        $etudiantName = Session::get('etudiant_name');
        $etudiantFiliere = Session::get('etudiant_filiere');
        $etudiantEmail = Session::get('etudiant_email');
        $etudiantPassword = Session::get('etudiant_password');


        return view('etudiant.etudiants', [
            'etudiantId' => $etudiantId,
            'etudiantName' => $etudiantName,
            'etudiantFiliere' => $etudiantFiliere,
            'etudiantEmail'=> $etudiantEmail,
            'etudiantPassword'=> $etudiantPassword
        ]);
    }

    public function etudiantSeances()
    {
        $etudiantName = Session::get('etudiant_name'); 
        $etudiantFiliere = Session::get('etudiant_filiere');
        $seances = array();

        // Retrieve the seances for the given etudiant ID
        $seancesData = EmploiFiliere::where('filiere', $etudiantFiliere)->get();

        foreach ($seancesData as $seance) {
            // Convert French day name to English
            $dayOfWeek = $seance->jour_semaine;

            // Map day names to integers (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
            $dayOfWeekInteger = [
                'Monday' => 1,
                'Tuesday' => 2,
                'Wednesday' => 3,
                'Thursday' => 4,
                'Friday' => 5,
                'Saturday' => 6,
                'Sunday' => 0
            ];

            // Construct the start and end time with the current date
            $seances[] = [
                'id' => $seance->id,
                'title' => $seance->matiere . ' - Salle:' . $seance->id_salle,
                'start' => $seance->heure_debut,
                'end' => $seance->heure_fin,
                'dow' => [$dayOfWeekInteger[$dayOfWeek]],
            ];
        }

        return view('etudiant.emploi', ['etudiantName' => $etudiantName,'seances' => $seances]);
    }

    public function etudiantmdp(Request $request) {
        // Validate the request
        $request->validate([
            'password' => 'required|string',
            'id' => 'required|integer', // Ensure the ID exists in the etudiants table
        ]);

        // Find the student by ID
        $etudiant = etudiant::findOrFail($request->id);

        // Update the student's password
        $etudiant->password = $request->password;
        $etudiant->save();

        if (Session::get('etudiant_id') == $etudiant->id) {
            Session::put('etudiant_password', $etudiant->password);
        }

        // Return a response
        return redirect()->route('Dashboard.etudiant');
    }

    public function destroy($id) {
        // Find the student by ID
        $etudiant = Etudiant::findOrFail($id);
    
        // Delete the student
        $etudiant->delete();
    
        // Return a response
        return response()->json(['success' => 'Student deleted successfully']);
    }

}
