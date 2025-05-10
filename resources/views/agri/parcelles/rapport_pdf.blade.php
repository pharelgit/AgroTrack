<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }

        h2 {
            color: #159957;
            margin-bottom: 5px;
        }

        p {
            margin: 2px 0;
        }

        .header, .footer {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .footer {
            border-top: 1px solid #ccc;
            border-bottom: none;
            margin-top: 20px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status {
            font-weight: bold;
        }

        .en-cours {
            color: #ff9800;
        }

        .terminee {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Rapport de la parcelle : {{ $parcelle->nom }}</h2>
        <p>Surface : <strong>{{ $parcelle->superficie }} ha</strong></p>
        <p>Nombre d'interventions : {{ $parcelle->interventions->count() }}</p>
        <p>Généré le : {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Type</th>
                <th>Description</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($parcelle->interventions as $intervention)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($intervention->date_debut)->format('d/m/Y') }}</td>
                    <td>{{ $intervention->date_fin ? \Carbon\Carbon::parse($intervention->date_fin)->format('d/m/Y') : 'En cours' }}</td>
                    <td>{{ $intervention->typeIntervention->nom }}</td>
                    <td>{{ $intervention->description ?: 'N/A' }}</td>
                    <td class="status {{ $intervention->date_fin ? 'terminee' : 'en-cours' }}">
                        {{ $intervention->date_fin < now() ? 'Terminée' : 'En cours' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Rapport généré automatiquement par AgroTrack.
    </div>
</body>
</html>
