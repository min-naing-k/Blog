<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Group By Age</title>
</head>

<body>
  <h1 style="text-align: center;margin: 1rem 0">Students Group By Age</h1>
  @foreach ($students as $age => $students)
    <div style="margin-bottom: .5rem">
      (No.{{ $loop->iteration }})Age {{ $age }}. <br />
    </div>
    <div style="margin-left: 1rem">
      Students: <br />
      <div style="margin-bottom: 1rem">
        @foreach ($students as $student)
          no.{{ $loop->iteration }}Name: {{ $student->name }}. <br />
        @endforeach
      </div>
    </div>
  @endforeach
</body>

</html>
