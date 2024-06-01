<form method="post" action="{{ route('seance.store') }}">
    @csrf
    <label for="filiere" class="form-label">filiere</label>
        <select class="form-select" id="filiere" name="filiere">
        <option value="IDSIT">IDSIT</option>
        <option value="GL">GL</option>
        <option value="SSE">SSE</option>
        <option value="SSI">SSI</option>
        <option value="2SCL">2SCL</option>
        <option value="IDF">IDF</option>
        <option value="2IA">2IA</option>
        <option value="BI">BI</option>
        </select>
    <label for="jour_semaine" class="form-label">jour</label>
        <select class="form-select" id="jour_semaine" name="jour_semaine">
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <option value="Mercredi">Mercredi</option>
        <option value="Jeudi">Jeudi</option>
        <option value="Vendredi">Vendredi</option>
        </select>
    <label for="heure_debut" class="form-label">Heure de debut</label>
    <input type="time" class="form-control" id="heure_debut" name="heure_debut">
    <label for="heure_fin" class="form-label">Heure de fin</label>
    <input type="time" class="form-control" id="heure_fin" name="heure_fin">
    <label for="id_salle" class="form-label">Id de la salle</label>
    <input type="text" class="form-control" id="id_salle" name="id_salle">
    <label for="id_enseignant" class="form-label">Id de l'enseignant</label>
    <input type="text" class="form-control" id="id_enseignant" name="id_enseignant">
    <label for="matiere" class="form-label">matiere</label>
    <input type="text" class="form-control" id="matiere" name="matiere">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>