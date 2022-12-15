<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Student</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('student.create') }}"> Create student</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> FirstName</th>
                    <th> LastName</th>
                    <th> Email</th>
                    <th> Phone</th>
                    <th>School</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name  }}</td>
                        <td>{{ $student->last_name  }}</td>
                        <td>{{ $student->email  }}</td>
                        <td>{{ $student->phone  }}</td>
                        <td>{{ $student->school->name  }}</td>
                        <td>
                            <form action="{{ route('student.destroy',$student->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('student.edit',$student->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $students->links() !!}
    </div>
</body>
</html>

