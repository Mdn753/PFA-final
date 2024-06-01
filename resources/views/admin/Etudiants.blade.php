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
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            width: 100%;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .content-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .action-icon {
            margin-right: 10px;
            color: #009879; /* Match the color of the table */
            text-decoration: none; /* Remove underline from links */
            font-size: 1.2em; /* Adjust size as needed */
        }

        .action-icon:hover {
            color: #007766; /* Change color on hover */
        }
        .delete-icon {
            margin-right: 10px;
            color: #009879; /* Match the color of the table */
            text-decoration: none; /* Remove underline from links */
            font-size: 1.2em; /* Adjust size as needed */
        }

        .delete-icon:hover {
            color: #007766; /* Change color on hover */
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
        .dark {
            background-color: #222;
            color: #fff;
            /* Add other styles for dark mode here */
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

    <section class="home">
        <div class="text">Bonjour, {{ $adminName }}</div>
        <div class="container">
            <div class="text">Liste des Etudiants</div>
        </div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Nom et Prenom</th>
                    <th>Filiere</th>
                    <th>Email</th>
                    <th>Mot de Passe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etudiants as $etu)
                    <tr>
                        <td>{{ $etu->name }}</td>
                        <td>{{ $etu->filiere }}</td>
                        <td>{{ $etu->email }}</td>
                        <td>{{ $etu->password }}</td>
                        <td>
                            <!-- Edit icon -->
                            <a href="" class="action-icon" data-bs-toggle="modal" data-id="{{ $etu->id }}" data-name="{{ $etu->name }}" data-filiere="{{ $etu->filiere }}" data-email="{{ $etu->email }}" data-password="{{ $etu->password }}" data-bs-target="#EtudiantEditModal"><i class="bx bx-edit"></i></a>
                            <!-- Delete icon -->
                            <a href="" class="delete-icon" data-id="{{ $etu->id }}" ><i class='bx bxs-x-circle' ></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <button type="button" id="addButton">Ajouter</button>
        
        <!-- Modal -->
        <div class="modal fade" id="EtudiantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un etudiant</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <!--             <label for="filiere">filiere:</label>
                <input type="text" class="form-control" id="filiere"> -->
                <label for="name">nom et prenom:</label>
                <input type="text" class="form-control" id="name">
                <label for="filiere">filiere:</label>
                <input type="text" class="form-control" id="filiere">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email">
                <label for="mdp">Mot de passe:</label>
                <input type="text" class="form-control" id="mdp">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBTN" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="EtudiantEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier un etudiant</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId">
                        <label for="editName">Nom et Prenom:</label>
                        <input type="text" class="form-control" id="editName">
                        <label for="editFiliere">Filiere:</label>
                        <input type="text" class="form-control" id="editFiliere">
                        <label for="editEmail">Email:</label>
                        <input type="text" class="form-control" id="editEmail">
                        <label for="editMdp">Mot de passe:</label>
                        <input type="text" class="form-control" id="editMdp">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveBTNEdit" class="btn btn-primary">Save changes</button>
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
                var name = $('#name').val();
                var filiere = $('#filiere').val();
                var email = $('#email').val();
                var password = $('#mdp').val();

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
                        console.log('Student added successfully:', response);
                        // Refresh the student list or update the UI as needed
                        location.reload();
                    },
                    error: function(error) {
                        console.error('Error adding student:', error);
                    }
                });

                // Close the modal
                $('#EtudiantModal').modal('hide');
                });
    
                $('.action-icon').on('click', function(event) {
                    event.preventDefault(); // Prevent default action of anchor tag
                    var id = $(this).data('id');
                    var name = $(this).data('name');
                    var filiere = $(this).data('filiere');
                    var email = $(this).data('email');
                    var password = $(this).data('password');

                    $('#editId').val(id);
                    $('#editName').val(name);
                    $('#editFiliere').val(filiere);
                    $('#editEmail').val(email);
                    $('#editMdp').val(password);
                });


                // Handle form submission for editing a student
                $('#saveBTNEdit').on('click', function() {
                    var id = $('#editId').val();
                    var name = $('#editName').val();
                    var filiere = $('#editFiliere').val();
                    var email = $('#editEmail').val();
                    var password = $('#editMdp').val();

                    $.ajax({
                        url: "{{ route('etudiant.update', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { name: name, filiere: filiere, email: email, password: password },
                        success: function(response) {
                            console.log('Student updated successfully:', response);
                            location.reload();
                        },
                        error: function(error) {
                            console.error('Error updating student:', error);
                        }
                    });

                    $('#EtudiantEditModal').modal('hide');
                });
                // Handle delete action
                $('.delete-icon').on('click', function(event) {
                    event.preventDefault(); // Prevent default action of anchor tag
                    var id = $(this).data('id');

                    if (confirm('Voulez vous supprimer?')) {
                        $.ajax({
                            url: "{{ route('etudiant.destroy', '') }}" + '/' + id,
                            type: "DELETE",
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('Student deleted successfully:', response);
                                location.reload();
                            },
                            error: function(error) {
                                console.error('Error deleting student:', error);
                            }
                        });
                    }
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
                } else {
                    modeText.innerText = "Dark mode";
                }
            });

    </script>
</body>
</html>
