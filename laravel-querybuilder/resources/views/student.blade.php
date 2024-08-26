<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .create-button {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            margin-left: 30px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create-button:hover {
            background-color: #0056b3;
        }

        .table-container {
            margin: 20px auto;
            padding: 20px;
            max-width: 1200px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .table-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #007BFF;
            color: #fff;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        .action-links a:hover {
            text-decoration: underline;
        }
        @media only screen and (max-width: 667px) {
    .table-container {
        width: 100%; /* or a suitable percentage */
        overflow-x: auto; /* Allows horizontal scrolling */
        -webkit-overflow-scrolling: touch; /* Adds smooth scrolling on iOS */
    }
    table {
        width: 100%; /* Ensures the table occupies full width of the container */
    }
}

    </style>
</head>

<body>

    <a href="{{route('student.create')}}" class="create-button">Create</a>
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="table-container">
        <h2>Student Information</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th style="width:120px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->phone}}</td>
                    <td>{{$student->date_of_birth}}</td>
                    <td>{{$student->gender}}</td>
                    <td>{{$student->address}}</td>
                    <td>{{$student->created_at}}</td>
                    <td>{{$student->updated_at}}</td>
                    <td class="action-links"><a href="{{ route('student.edit', $student->id) }}">edit</a>
                        <a href="{{route('student.delete',$student->id)}}">delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</body>

</html>