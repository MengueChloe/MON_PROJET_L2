<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ActTogether - Accusé de réception de votre candidature</title>
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
            <h2>Accusé de réception de votre candidature</h2>
            <p>Bonjour {{ $candidature->benevole->user->name }},</p>
            <p>Nous avons bien reçu votre candidature pour la mission <strong>{{ $candidature->mission->title }}</strong>.</p>
            <p>Votre candidature est actuellement en attente de validation par l'organisation. Vous serez informé(e) dès que son statut sera mis à jour (acceptée ou refusée).</p>
            <p>Merci de votre engagement et de votre intérêt pour cette mission !</p>
            <p>
                <a href="{{ route('missions.show', $candidature->mission) }}" class="btn">Voir la mission</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} ActTogether. Tous droits réservés.</p>
            <p><a href="{{ url('/') }}">Visitez notre site</a></p>
        </div>
    </div>
</body>
</html>