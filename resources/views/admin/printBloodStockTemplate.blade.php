<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Stock Details Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }

        h2 {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

    <h2>Blood Stock Details</h2>

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Blood Type</th>
                    <th>Units</th>
                    <th>Status</th>
                    <th>Expire Date</th>
                    <th>Hospital ID</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bloodStock_details as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->bloodType }}</td>
                        <td>{{ $item->units }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->expireDate }}</td>
                        <td>{{ $item->hospital_id }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
