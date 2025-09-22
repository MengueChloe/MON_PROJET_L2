<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ActTogether - Nouvelle activité assignée</title>
    <style>
        :root {
            --primary-color: #e2001a;
            --secondary-color: #ff7f00;
            --light-color: #f8f9fc;
            --dark-color: #333333;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), #a50012);
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .details {
            background: var(--light-color);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--primary-color);
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #c10015;
        }

        .footer {
            background: var(--dark-color);
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
            opacity: 0.8;
        }

        .footer a:hover {
            opacity: 1;
        }

        @media only screen and (max-width: 600px) {
            .container {
                margin: 10px;
            }

            .content {
                padding: 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content h2 {
                font-size: 18px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ActTogether</h1>
        </div>
        <div class="content">
            <h2>Nouvelle activité assignée</h2>
            <p>Bonjour {{ $activite->benevole->user->name }},</p>
            <p>Vous avez été assigné(e) à une nouvelle activité dans le cadre de la mission <strong>{{ $activite->mission->title }}</strong>.</p>
            <div class="details">
                <p><strong>Titre de l'activité :</strong> {{ $activite->title }}</p>
                <p><strong>Description :</strong> {{ Str::limit($activite->description, 150) }}</p>
                @if ($activite->location)
                    <p><strong>Lieu :</strong> {{ $activite->location }}</p>
                @endif
                @if ($activite->start_time)
                    <p><strong>Début :</strong> {{ $activite->start_time }}</p>
                @endif
                @if ($activite->end_time)
                    <p><strong>Fin :</strong> {{ $activite->end_time }}</p>
                @endif
                @if ($activite->objective)
                    <p><strong>Objectif :</strong> {{ Str::limit($activite->objective, 100) }}</p>
                @endif
                @if ($activite->responsable)
                    <p><strong>Responsable :</strong> {{ $activite->responsable->name }}</p>
                @else
                    <p><strong>Responsable :</strong> Non assigné</p>
                @endif
            </div>
            <p>Veuillez consulter les détails dans votre tableau de bord pour plus d'informations ou pour contacter l'organisation.</p>
            <p>
                <a href="{{ route('tasks.index') }}" class="btn">Voir mes activités</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} ActTogether. Tous droits réservés.</p>
            <p><a href="{{ url('/') }}">Visitez notre site</a></p>
        </div>
    </div>
</body>
</html>