<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Probléme de connexion | Log Dist Du Nord</title>
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold">500</h1>
            <p class="fs-3"> <span class="text-danger">Opps!</span> Probléme de connexion.</p>
            <p class="lead">
                Nous avons remarqué que vous rencontrez des problèmes de connexion lors de l'utilisation de l'application.
              </p>
            <a href="{{ route('adminDashboard') }}" class="btn btn-warning fw-bold text-white">Retour</a>
        </div>
    </div>
</body>
</html>