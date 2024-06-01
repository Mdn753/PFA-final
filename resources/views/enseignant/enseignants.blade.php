<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <style>
        .details {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .details p {
            margin-bottom: 10px;
        }
        .details p strong {
            display: inline-block;
            width: 150px;
        }
        .details p .info {
            font-weight: normal;
            color: #495057;
        }
        button {
            color: #ffffff;
            padding: 8px 22px;
            border-radius: 6px;
            background: #009879; /* Match the color of the table */
            transition: all 0.2s ease;
            display: block; /* Center the button */
            margin: 0 auto; /* Center the button */
        }

        button:active {
            transform: scale(0.96);
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
                        <a href="{{route('Dashboard.enseignant')}}">
                            <i class='bx bxs-face' ></i>
                            <span class="text nav-text">Personal data</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{route('enseignant.emploi')}}">
                        <i class='bx bxs-calendar'></i>
                            <span class="text nav-text">Timetable</span>
                        </a>
                    </li>

                    <!-- <li class="nav-link">
                        <a href="{{route('seance.idsit')}}">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Les emplois</span>
                        </a>
                    </li> -->

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="{{route('viewlogin.enseignant')}}">
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

    <section class="home">
        <div class="text">Bonjour, {{$enseignantName}}</div>
        <div class="details">
            <p><strong>Nom:</strong> <span class="info">{{ $enseignantName }}</span></p>
            <p><strong>Matière:</strong> <span class="info">{{ $enseignantMatiere }}</span></p>
            <p><strong>Email:</strong> <span class="info">{{ $enseignantEmail }}</span></p>
            <!-- Assuming you're displaying the password for some specific reason -->
            <p><strong>Mot de passe:</strong> <span class="info">{{ $enseignantPassword }}</span></p>
        </div>
        <button type="button" id="addButton">Modifier</button>

        <!-- Modal -->
        <div class="modal fade" id="EtudiantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le mot de passe</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <!--             <label for="filiere">filiere:</label>
                <input type="text" class="form-control" id="filiere"> -->
                <label for="passwo">le nouveau mot de passe:</label>
                <input type="text" class="form-control" id="password">
                <input type="hidden" id="enseignantId" value="{{ $enseignantId }}"

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBTN" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl-7/9eUyh2cfyZivnKqOn7z5W5i5i6AU6Yj6HIb6Ii3MAvo5/4p6IBsV0p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGujAddI23Ibmx2l6E/rLaa3eHe5f6Ht/2l26pVtKt5C6C8/sty6k8TX9K1" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                    // Show modal when "Ajouter" button is clicked
                    $('#addButton').on('click', function() {
                        $('#EtudiantModal').modal('toggle');
                    });

                    // Handle form submission
                    $('#saveBTN').on('click', function() {
                    var mdp = $('#mdp').val();
                    var enseignantId = $('#enseignantId').val();

                    // Log form data to console (for testing purposes)
                    // console.log('Form Data:', { name, filiere, email, password });

                    // Perform AJAX request to server
                    $.ajax({
                        url: "{{ route('enseignant.mdp') }}", // Update with your route
                        type: 'PATCH',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { password: mdp, id: enseignantId },
                        success: function(response) {
                            console.log('enseignant added successfully:', response);
                            // Refresh the enseignant list or update the UI as needed
                            location.reload();
                        },
                        error: function(error) {
                            console.error('Error adding enseignant:', error);
                        }
                    });

                    // Close the modal
                    $('#EtudiantModal').modal('hide');
                });
            });
        </script>
    </section>
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
    <script>
        $(document).ready(function() {
                // Show modal when "Ajouter" button is clicked
                $('#addButton').on('click', function() {
                    $('#EtudiantModal').modal('toggle');
                });

                // Handle form submission
                $('#saveBTN').on('click', function() {
                var mdp = $('#mdp').val();

                // Log form data to console (for testing purposes)
                console.log('Form Data:', { name, filiere, email, password });

                // Perform AJAX request to server
                $.ajax({
                    url: "{{ route('etudiant.store') }}", // Update with your route
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { name, filiere, email, password },
                    success: function(response) {
                        console.log('enseignant added successfully:', response);
                        // Refresh the enseignant list or update the UI as needed
                        location.reload();
                    },
                    error: function(error) {
                        console.error('Error adding enseignant:', error);
                    }
                });

                // Close the modal
                $('#EtudiantModal').modal('hide');
            });
        });
    </script>


</body>
</html>