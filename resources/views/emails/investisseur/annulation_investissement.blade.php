<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation de votre investissement</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #d32f2f;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-content {
            margin-top: 20px;
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        .email-content p {
            margin: 15px 0;
        }

        .highlight {
            font-weight: bold;
            color: #d32f2f;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

        .footer a {
            color: #1a73e8;
            text-decoration: none;
        }

        .button {
            background-color: #1a73e8;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Annulation de votre investissement</h1>
        </div>

        <!-- Body content -->
        <div class="email-content">
            <p>Bonjour {{ $compteInvestisseur->nom }} {{ $compteInvestisseur->prenom }},</p>
            <p>Nous regrettons de vous informer que votre demande d'investissement a été <span
                    class="highlight">annulée</span> en raison d'un solde insuffisant sur votre compte.</p>

            <p><strong>Détails de la transaction :</strong></p>
            <ul>
                <li><strong>Description : </strong>{{ $description }}</li>
                <li><strong>Montant à investir : </strong>{{ $montant }} FCFA</li>
                <li><strong>Votre solde : </strong>{{ $compteInvestisseur->solde }} FCFA</li>

            </ul>

            <p>Votre solde actuel est insuffisant pour compléter cette opération. Veuillez ajouter des fonds à votre
                compte et réessayer si vous souhaitez poursuivre l'investissement.</p>

            <p>Nous vous prions de nous excuser pour ce désagrément et restons à votre disposition pour toute question.
            </p>

        </div>
    </div>
</body>

</html>
