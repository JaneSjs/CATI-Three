<!DOCTYPE html>
<html>
<head>
    <title>Survey Results</title>
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
        Survey Results
    </h5>

    @foreach($results as $result)
    <h6>
        Interview ID: {{ $result->interview_id }}
    </h6>

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

            @foreach($resultContent as $question => $answer)
               <tr>
                   <td>{{ $question }}</td>
                   <td>
                       @if(is_array($answer))
                         {{ json_encode($answer) }}
                       @else
                        {{ $answer }}
                       @endif
                   </td>
               </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</body>
</html>
