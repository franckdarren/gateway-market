<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vous venez d'acquérir un investisseur</title>
    <style>
        /* Reset CSS */
        body,
        h1,
        p {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Global Styles */
        body {
            background-color: #f4f7fc;
            color: #333;
            line-height: 1.6;
            font-size: 16px;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #2C3E50;
            margin-bottom: 20px;
            font-weight: 600;
        }

        p {
            font-size: 16px;
            color: #4F5B66;
            margin-bottom: 15px;
        }

        .highlight {
            font-weight: 600;
            color: #27AE60;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            color: #7f8c8d;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bonjour {{ $compteStartup->nom }},</h1>
        <p>Nous avons le plaisir de vous informer que vous venez d'acquérir un nouvel investisseur.</p>

        <p><strong>Description de l'investissement :</strong> {{ $description }}</p>
        <p><strong>Montant investi :</strong> <span class="highlight">{{ number_format($montant, 0, ',', '.') }} FCFA</span></p>
        <p><strong>Statut de la transaction :</strong> <span class="highlight">{{ $statut }}</span></p>
        <p><strong>Votre nouveau solde est :</strong> <span class="highlight">{{ number_format($compteStartup->solde, 0, ',', '.') }} FCFA</span></p>

        <p><strong>Investisseur :</strong> <span class="highlight">{{ $compteInvestisseur->nom }}
                {{ $compteInvestisseur->prenom }}</span></p>
        <p><strong>Pays :</strong> <span class="highlight">{{ $compteInvestisseur->pays }}</span></p>
        <p><strong>Ville :</strong> <span class="highlight">{{ $compteInvestisseur->ville }}</span></p>
        <p><strong>Téléphone :</strong> <span class="highlight">{{ $compteInvestisseur->phone }}</span></p>
        <p><strong>Email :</strong> <span class="highlight">{{ $compteInvestisseur->email }}</span></p>

        <p>Nous vous remercions pour votre confiance et restons à votre disposition pour toute question.</p>
    </div>
</body>

</html>
