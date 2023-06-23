<!DOCTYPE html>
<html>
<head>
    <title>Survey Result Details</title>
    <style>
        /* CSS styles for the result table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h5>
        Survey Result - ID: {{ $result->id }}
    </h5>

    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
            </tr>
        </thead>
        <tbody>
            @php
                $resultContent = json_decode($result->content, true);
            @endphp

            @foreach ($resultContent as $question => $answer)
                <tr>
                    <td>{{ $question ??  }}</td>
                    <td>{{ $answer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
