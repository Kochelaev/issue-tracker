<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>template</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="http://{getenv('HOST')}">
                Issue tracker
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto">                       
                        
                    
                    <li class="nav-item pl-3">
                        {if $user = $Auth::check()}
                             Вы вошли как: {$user->email}
                            <a class="nav-link" href="http://{getenv('HOST')}/Auth.logout">Выйти</a>
                            
                        {else}
                           <a class="nav-link" href="http://{getenv('HOST')}/Auth.authform">Вход</a>
                        {/if}
                    </li>
           
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-2 pt-1 mb-4"> 
        
        {if $warning}
        <div class="alert alert-danger mt-2" role="alert">
            {$warning}
        </div>
        {/if}