<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .nav-link {
            font-size: 1.2em;
            font-weight: bold;
            color: black;
            transition: color 0.3s;
        }
        .nav-link:hover {
            color: #333; /* Slightly lighter black for hover */
        }
        .nav-item {
            margin: 0 10px;
        }
        .nav {
            margin-top: 20px;
        }
    </style>
    <title>Dashboard</title>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('images/emp.png') }}" alt="GEDT Logo">
                </span>

                <div class="text logo-text">
                    <span class="name">GEDT</span>
                    <span class="profession">Gestion des emplois</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <!-- <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li> -->

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="{{route('etudiant.show')}}">
                            <i class='bx bxs-user-pin'></i>
                            <span class="text nav-text">etudiants</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{route('enseignant.show')}}">
                            <i class='bx bx-user-pin' ></i>
                            <span class="text nav-text">Enseignants</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{route('seance.idsit')}}">
                            <i class='bx bxs-calendar'></i>
                            <span class="text nav-text">Les emplois</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="{{route('viewlogin.admin')}}">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <!-- <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li> -->
                
            </div>
        </div>

    </nav>
    <!-- Modal -->
    <div class="modal fade" id="seanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une seance</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
<!--             <label for="filiere">filiere:</label>
            <input type="text" class="form-control" id="filiere"> -->
            <label for="id_salle">numero de la salle:</label>
            <input type="text" class="form-control" id="id_salle">
            <label for="id_enseignant">numero de l'enseignant:</label>
            <input type="text" class="form-control" id="id_enseignant">
            <label for="matiere">Matiere:</label>
            <input type="text" class="form-control" id="matiere">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="saveBTN" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    <section class="home">
        <div class="container">
            <div class="text">Les Emplois des filieres</div>
        </div>
        <div class="container">
            <div class="text">GL</div>
        </div>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seance.idsit') }}">IDSIT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seance.gl') }}">GL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seance.sse') }}">SSE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seance.ssi') }}">SSI</a>
            </li>
        </ul>
        <div id=timetable>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            var seances = @json($seances);
            console.log(seances);
            $('#timetable').fullCalendar({
                defaultView: 'agendaWeek',
                selectable: true,
                selectHelper: true,
                nowIndicator: false,
                header:{
                    left : 'next',
                    right: 'agendaWeek',
                },
                hiddenDays: [0, 6],
                events: seances,
                minTime: '08:00:00', 
                maxTime: '18:00:00',
                select: function(start,end){
                    $('#seanceModal').modal('toggle');

                    $('#saveBTN').off('click').on('click',function(){
                        var id = event.id;
                        var filiere = "GL";
                        var jour_semaine = start.format('dddd');
                        var heure_debut = start.format('HH:mm:ss');
                        var heure_fin = end.format('HH:mm:ss');
                        var id_salle = $('#id_salle').val();
                        var id_enseignant = $('#id_enseignant').val();
                        var matiere = $('#matiere').val();
                        //console.log(filiere,jour_semaine,heure_debut,heure_fin,id_salle,id_enseignant,matiere);

                        $.ajax({
                        url : "{{ route('seance.store') }}",
                        type: "POST",
                        dataType:"json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id,filiere,jour_semaine,heure_debut,heure_fin,id_salle,id_enseignant,matiere},
                        success:function(response){
                            $('#seanceModal').modal('hide'),
                            $('#timetable').fullCalendar('refetchEvents');
                            Swal.fire({
                                title: "SUCCESS!",
                                text: "Séance ajoutée!",
                                icon: "success"
                            });
                            // $('#timetable').fullCalendar('refetchEvents');

                            // $('#timetable').fullCalendar('renderEvent',{
                            //     'matiere': response.matiere,
                            //     'start' : response.heure_debut,
                            //     'end' : response.heure_fin,
                            // })
                            //console.log(response);
                        },
                        error:function(error){
                            Swal.fire({
                                title: "Erreur!",
                                text: "Impossible d'ajouter une séance!",
                                icon: "error"
                            });
                            console.log(error);
                        }
                        });
                    });

                },
                editable: true,
                eventDrop: function(event){
                    var id = event.id;
                    //console.log(event);
                    var jour_semaine = event.start.format('dddd');
                    var heure_debut = event.start.format('HH:mm:ss');
                    var heure_fin = event.end.format('HH:mm:ss');


                    $.ajax({
                        url : "{{ route('seance.update', '') }}" + '/'+id,
                        type: "PATCH",
                        dataType:"json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{jour_semaine,heure_debut,heure_fin},
                        success:function(response){
                            
                            Swal.fire({
                                title: "SUCCESS!",
                                text: "Séance mise à jour!",
                                icon: "success"
                            });
                            console.log(response);
                        },
                        error:function(error){
                            Swal.fire({
                                title: "Erreur!",
                                text: "Impossible de mettre à jour la séance!",
                                icon: "error"
                            });
                            console.log(error);
                            $('#timetable').fullCalendar('refetchEvents');
                        }
                        });
                },
                eventClick: function(event){
                    var id = event.id;
                    if(confirm("are you sure to remove it ?")){
                        $.ajax({
                        url : "{{ route('seance.destroy', '') }}" + '/'+id,
                        type: "DELETE",
                        dataType:"json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(response){
                            $('#timetable').fullCalendar('removeEvents',response);
                            Swal.fire({
                                title: "Good job!",
                                text: "Séance supprimée!",
                                icon: "success"
                            });
                            console.log(response);

                        },
                        error:function(error){
                            Swal.fire({
                                title: "Error!",
                                text: "Event not deleted!",
                                icon: "error"
                            });
                            console.log(error);
                        }
                        });
                    }
                    
                }


            })
        });

    </script>
    <script>
            const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");


            toggle.addEventListener("click" , () =>{
                sidebar.classList.toggle("close");
            })

            searchBtn.addEventListener("click" , () =>{
                sidebar.classList.remove("close");
            })

            modeSwitch.addEventListener("click" , () =>{
                body.classList.toggle("dark");
                
                if(body.classList.contains("dark")){
                    modeText.innerText = "Light mode";
                }else{
                    modeText.innerText = "Dark mode";
                    
                }
            });
    </script>

</body>
</html>