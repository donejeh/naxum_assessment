<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Multiple Level Marketing</title>

    <link rel="stylesheet" href="{{ ('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ ('css/bootstrap.min.css') }}">
    

</head>
<body>


    <div class="container" style="margin-top: 50px;">
 
      <h2>PART A => TASK 2 </h2>

    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">TOP</th>
          <th scope="col">Distributor Name</th>
          <th scope="col">Total Sales</th>
        </tr>
      </thead>
      <tbody>

          @foreach ($topUsers as $topUser)

          <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td> {{ $topUser->first_name }} {{ $topUser->last_name }} </td>
              <td>  ${{ $topUser->total }} </td>
          </tr>
          @endforeach
       
      </tbody>
    </table>
    {{ $topUsers->links('paginate') }}

    <a href="{{ route('index') }}" class="ml-0 mr-0">GO BACK TO ORDER PAGE</a>

</div>

</div>
        <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.js') }}"></script>


</body>
</html>