<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\EmploiFiliere;




class EnseignantController extends Controller
{
    //
    public function allEnseignants(){
        $enseignants = Enseignant::all();
        $adminName = Session::get('admin_name');

        return view('admin.Enseignant',['enseignants'=> $enseignants,'adminName' => $adminName]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $enseignant = DB::table('enseignant')->where('email', $request->email)->first();

        if ($enseignant && $request->password === $enseignant->password) {
            // Login successful, store admin information in the session
            $request->session()->put('enseignant_id', $enseignant->id);
            $request->session()->put('enseignant_name', $enseignant->name);
            $request->session()->put('enseignant_matiere', $enseignant->matiere); // Store the admin's name
            $request->session()->put('enseignant_email', $enseignant->email);
            $request->session()->put('enseignant_password', $enseignant->password);

            // Redirect to admin dashboard
            return redirect()->route('Dashboard.enseignant');
        }

        // Authentication failed
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function store(Request $request){
        $validatedData=$request->validate([
            'name'=>'required',
            'matiere'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        Enseignant::create($validatedData);
        return redirect()->route('Enseignant.show');
    }

    public function Dashboard(){
        $enseignantId = Session::get('enseignant_id');
        $enseignantName = Session::get('enseignant_name');
        $enseignantMatiere = Session::get('enseignant_matiere');
        $enseignantEmail = Session::get('enseignant_email');
        $enseignantPassword = Session::get('enseignant_password');


        return view('enseignant.enseignants', [
            'enseignantId' => $enseignantId,
            'enseignantName' => $enseignantName,
            'enseignantMatiere' => $enseignantMatiere,
            'enseignantEmail'=> $enseignantEmail,
            'enseignantPassword'=> $enseignantPassword
        ]);
    }
    public function enseignantSeances()
    {
        $enseignantName = Session::get('enseignant_name'); 
        $enseignantId = Session::get('enseignant_id');
        $seances = array();

        // Retrieve the seances for the given enseignant ID
        $seancesData = EmploiFiliere::where('id_enseignant', $enseignantId)->get();

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
                'title' => $seance->filiere . ' - Salle:' . $seance->id_salle,
                'start' => $seance->heure_debut,
                'end' => $seance->heure_fin,
                'dow' => [$dayOfWeekInteger[$dayOfWeek]],
            ];
        }

        return view('enseignant.emploi', ['enseignantName' => $enseignantName,'seances' => $seances]);
    }

    public function enseignantmdp(Request $request) {
        // Validate the request
        $request->validate([
            'password' => 'required|string',
            'id' => 'required|integer', // Ensure the ID exists in the enseignants table
        ]);

        // Find the student by ID
        $enseignant = enseignant::findOrFail($request->id);

        // Update the student's password
        $enseignant->password = $request->password;
        $enseignant->save();

        if (Session::get('enseignant_id') == $enseignant->id) {
            Session::put('enseignant_password', $enseignant->password);
        }

        // Return a response
        return redirect()->route('Dashboard.enseignant');
    }
    

    public function update(Request $request, $id) {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'matiere' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string', 
        ]);

        // Find the student by ID
        $enseignant = enseignant::findOrFail($id);

        // Update the student's details
        $enseignant->name = $request->name;
        $enseignant->matiere = $request->matiere;
        $enseignant->email = $request->email;
        $enseignant->password = $request->password; 

        // Save the updated student details
        $enseignant->save();

        // Return a response
        return response()->json(['success' => 'Teacher updated successfully']);
    }

    public function destroy($id) {
        // Find the student by ID
        $enseignant = enseignant::findOrFail($id);
    
        // Delete the student
        $enseignant->delete();
    
        // Return a response
        return response()->json(['success' => 'teacher deleted successfully']);
    }


}
