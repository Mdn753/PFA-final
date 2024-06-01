<?php

namespace App\Http\Controllers;

use App\Models\EmploiFiliere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class EmploiController extends Controller
{
    //
    public function idsit(){
        $seances = array();
        $designatedFiliereIds ='IDSIT'; // Example array of designated filiere IDs

        // Retrieve only the timetables related to the designated filieres
        $emploi = EmploiFiliere::whereIn('filiere', [$designatedFiliereIds])->get();

        foreach ($emploi as $emploi) {
            // Convert French day name to English
            $dayOfWeek = $emploi->jour_semaine;
        
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
                'id' => $emploi->id,
                'title' => $emploi->matiere . ' - Salle:' . $emploi->id_salle,
                'start' => $emploi->heure_debut,
                'end' => $emploi->heure_fin,
                'dow' => [$dayOfWeekInteger[$dayOfWeek]],
            ];
        }
        
        
    
        return view('emploi.idsit.idsit',['seances' => $seances]);
    }


    public function gl(){
        $seances = array();
        $designatedFiliereIds ='GL'; // Example array of designated filiere IDs

        // Retrieve only the timetables related to the designated filieres
        $emploi = EmploiFiliere::whereIn('filiere', [$designatedFiliereIds])->get();

        foreach ($emploi as $emploi) {
            // Convert French day name to English
            $dayOfWeek = $emploi->jour_semaine;
        
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
                'id' => $emploi->id,
                'title' => $emploi->matiere . ' - Salle:' . $emploi->id_salle,
                'start' => $emploi->heure_debut,
                'end' => $emploi->heure_fin,
                'dow' => [$dayOfWeekInteger[$dayOfWeek]],
            ];
        }
        
        
    
        return view('emploi.gl.gl',['seances' => $seances]);
    }
    public function sse(){
        $seances = array();
        $designatedFiliereIds ='SSE'; // Example array of designated filiere IDs

        // Retrieve only the timetables related to the designated filieres
        $emploi = EmploiFiliere::whereIn('filiere', [$designatedFiliereIds])->get();

        foreach ($emploi as $emploi) {
            // Convert French day name to English
            $dayOfWeek = $emploi->jour_semaine;
        
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
                'id' => $emploi->id,
                'title' => $emploi->matiere . ' - Salle:' . $emploi->id_salle,
                'start' => $emploi->heure_debut,
                'end' => $emploi->heure_fin,
                'dow' => [$dayOfWeekInteger[$dayOfWeek]],
            ];
        }
        
        
    
        return view('emploi.sse.sse',['seances' => $seances]);
    } 
    public function ssi(){
        $seances = array();
        $designatedFiliereIds ='SSI'; // Example array of designated filiere IDs

        // Retrieve only the timetables related to the designated filieres
        $emploi = EmploiFiliere::whereIn('filiere', [$designatedFiliereIds])->get();

        foreach ($emploi as $emploi) {
            // Convert French day name to English
            $dayOfWeek = $emploi->jour_semaine;
        
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
                'id' => $emploi->id,
                'title' => $emploi->matiere . ' - Salle:' . $emploi->id_salle,
                'start' => $emploi->heure_debut,
                'end' => $emploi->heure_fin,
                'dow' => [$dayOfWeekInteger[$dayOfWeek]],
            ];
        }
        
        
    
        return view('emploi.ssi.ssi',['seances' => $seances]);
    } 


    // public function enseignantSeances(){
    //     $enseignantId = Session::get('enseignant_id');
    //     $seances = array();
    
    //     // Retrieve the seances for the given enseignant ID
    //     $seancesData = EmploiFiliere::where('id_enseignant', $enseignantId)->get();
    
    //     foreach ($seancesData as $seance) {
    //         // Convert French day name to English
    //         $dayOfWeek = $seance->jour_semaine;
        
    //         // Map day names to integers (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
    //         $dayOfWeekInteger = [
    //             'Monday' => 1,
    //             'Tuesday' => 2,
    //             'Wednesday' => 3,
    //             'Thursday' => 4,
    //             'Friday' => 5,
    //             'Saturday' => 6,
    //             'Sunday' => 0
    //         ];
        
    //         // Construct the start and end time with the current date
    //         $seances[] = [
    //             'id' => $seance->id,
    //             'title' => $seance->matiere,
    //             'start' => $seance->heure_debut,
    //             'end' => $seance->heure_fin,
    //             'dow' => [$dayOfWeekInteger[$dayOfWeek]],
    //         ];
    //     }
    
    //     return view('enseignant.emploi',['seances'=>$seances]);
    // }
    
    

    public function store(Request $request){

        $request->validate([
            'filiere' => 'required',
            'jour_semaine' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'id_salle' => 'required',
            'id_enseignant' => 'required',
            'matiere' => 'required',
        ]);

        $collisionEnseignant = EmploiFiliere::where('id_enseignant', $request->id_enseignant)
        ->where('jour_semaine', $request->jour_semaine)
        ->where(function($query) use ($request) {
            $query->whereBetween('heure_debut', [$request->heure_debut, $request->heure_fin])
                ->orWhereBetween('heure_fin', [$request->heure_debut, $request->heure_fin])
                ->orWhere(function($query) use ($request) {
                    $query->where('heure_debut', '<=', $request->heure_debut)
                          ->where('heure_fin', '>=', $request->heure_fin);
                });
        })
        ->exists();

        $collisionSalle = EmploiFiliere::where('id_salle', $request->id_salle)
            ->where('jour_semaine', $request->jour_semaine)
            ->where(function($query) use ($request) {
                $query->whereBetween('heure_debut', [$request->heure_debut, $request->heure_fin])
                    ->orWhereBetween('heure_fin', [$request->heure_debut, $request->heure_fin])
                    ->orWhere(function($query) use ($request) {
                        $query->where('heure_debut', '<=', $request->heure_debut)
                            ->where('heure_fin', '>=', $request->heure_fin);
                    });
            })
            ->exists();

        if ($collisionEnseignant) {
            return response()->json(['error' => 'Collision detected with another session for this teacher!'], 409);
        }

        if ($collisionSalle) {
            return response()->json(['error' => 'Collision detected with another session in this room!'], 409);
        }

        $seance = EmploiFiliere::create([
            'filiere' => $request->filiere,
            'jour_semaine' => $request->jour_semaine,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'id_salle' => $request->id_salle,
            'id_enseignant' => $request->id_enseignant,
            'matiere' => $request->matiere,
        ]);

        return response()->json($seance);
    }

    public function update(Request $request,$id){
        $request->validate([
            'jour_semaine' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        $seance = EmploiFiliere::find($id);
        if(! $seance){
            return response()->json([
                'error' => 'Unable to locate'
            ],404);
        }

        $collisionEnseignant = EmploiFiliere::where('id_enseignant', $seance->id_enseignant)
        ->where('jour_semaine', $request->jour_semaine)
        ->where(function($query) use ($request) {
            $query->whereBetween('heure_debut', [$request->heure_debut, $request->heure_fin])
                ->orWhereBetween('heure_fin', [$request->heure_debut, $request->heure_fin])
                ->orWhere(function($query) use ($request) {
                    $query->where('heure_debut', '<=', $request->heure_debut)
                          ->where('heure_fin', '>=', $request->heure_fin);
                });
        })
        ->where('id', '!=', $id) // Exclure la séance actuelle de la vérification
        ->exists();

        $collisionSalle = EmploiFiliere::where('id_salle', $request->id_salle)
            ->where('jour_semaine', $request->jour_semaine)
            ->where(function($query) use ($request) {
                $query->whereBetween('heure_debut', [$request->heure_debut, $request->heure_fin])
                    ->orWhereBetween('heure_fin', [$request->heure_debut, $request->heure_fin])
                    ->orWhere(function($query) use ($request) {
                        $query->where('heure_debut', '<=', $request->heure_debut)
                            ->where('heure_fin', '>=', $request->heure_fin);
                    });
            })
            ->where('id', '!=', $id) // Exclure la séance actuelle de la vérification
            ->exists();

        if ($collisionEnseignant) {
            return response()->json(['error' => 'Collision detected with another session for this teacher!'], 409);
        }

        if ($collisionSalle) {
            return response()->json(['error' => 'Collision detected with another session in this room!'], 409);
        }

        $seance->update([
            'jour_semaine' => $request->jour_semaine,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);
        return response()->json('Seance Updated');
    }
    
    public function destroy($id){
        $seance = EmploiFiliere::find($id);
        if(! $seance){
            return response()->json([
                'error' => 'Unable to locate'
            ],404);
        }
        $seance->delete();
        return $id; 
    }
    
}
