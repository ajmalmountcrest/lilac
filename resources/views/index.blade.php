<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    </head>
    <body >
        <section class="pt-4">
            <div class="container px-lg-5">
                <div class="row gx-lg-5 my-4">
                    <div class="col-lg-8 col-xxl-6 offset-lg-2 offset-xxl-3">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 ">
                            <div class="form-group">
                                <input type="text" id="search" class="form-control" placeholder="Search by name, department, or designation">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row gx-lg-5 my-4 user-container" id="user-container">
                    @foreach($users as $user)
                    <div class="col-lg-6 col-xxl-4 mb-5 pt-4">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 ">
                                
                                <h2 class="fs-4 fw-bold">{{ $user->name }}</h2>
                                <p >{{ optional($user->department)->name }}</p>
                                <p class="mb-0">{{ optional($user->designation)->name }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $('#search').on('keyup', function() {
                    var search = $(this).val();
                    $.ajax({
                        url: "{{ route('search') }}",
                        type: "GET",
                        data: {'search': search},
                        success: function(response) {
                            var userContainer = $('#user-container');
                            userContainer.html(''); 
                            console.log(response);

                            $.each(response, function(index, user) {
                                var userCard = `
                                    <div class="col-lg-6 col-xxl-4 mb-5 pt-4">
                                        <div class="card bg-light border-0 h-100">
                                            <div class="card-body text-center p-4 p-lg-5">
                                                <h2 class="fs-4 fw-bold">${user.name}</h2>
                                                <p>${user.department ? user.department.name : ''}</p>
                                                <p class="mb-0">${user.designation ? user.designation.name : ''}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                userContainer.append(userCard);
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>
