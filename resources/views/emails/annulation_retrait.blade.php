<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation de Retrait</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            /* Correction ici */
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin: 8px 0;
        }

        .highlight {
            color: #d9534f;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Bonjour !</h2>
        <p>Nous vous informons que votre retrait de <span class="highlight">{{ number_format($montant, 0, ',', '.') }} FCFA</span> a été annulé,
            car votre solde actuel est insuffisant. Le montant demandé est supérieur à votre solde disponible.</p>
        <p>Merci de vérifier votre solde ou de contacter notre support si vous avez des questions.</p>
        <p>Cordialement,</p>
        <p>L'équipe Gateway Market</p>
    </div>

</body>

</html>
