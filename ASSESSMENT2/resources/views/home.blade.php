<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Multiple Level Marketing Crud</title>

    <link rel="stylesheet" href="{{ ('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ ('css/bootstrap.min.css') }}">
    

</head>
<body>


    <div class="container" style="margin-top: 50px;">
 
      <h2>PART A => TASK 1 </h2>
        <fieldset class="border p-2 border-primary" style="margin-top: 20px;">
            <legend  class="w-auto border border-success">Transaction Report</legend>
                    <form class="mt-50" method="POST" action="{{ route('search') }}" style="margin-top: 20px;">
                        @csrf
                        <div class="form-group">
                            <label for="dateFrom" >Distributor</label>
                        <input type="text" name="search" class="form-control input-group-lg col-md-6 typeahead" placeholder="Search by ID, Username, First Name, Last Name" id="search" />

                          </div>

                        <div class="form-row">
                          <div class="form-group col-md-3">
                            <label for="dateFrom" >Date From:</label>
                        
                        <input type="date" class="form-control" name="from" value="<?php echo date('Y-m-d'); ?>" id="dateFrom" />
                          </div>
                          <div class="form-group col-md-3">
                            <label for="dateTo" class="">Date To:</label>
                       
                            <input type="date" class="form-control" name="to" value="<?php echo date('Y-m-d'); ?>" id="dateTo" />
                          </div>

                          <div class="form-group col-md-3">
                            
                            <button class="btn btn-primary" style="margin-top: 32px;" name="filter" type="submit" id="getJsonSrc">Filter</button>
                          </div>

                          <div class="form-group col-md-3">
                            <label for="inputPassword4">Total Commission: $<span id="sum"> </span> </label>
                            <input type="text" class="form-control" id="inputSearch" placeholder="Search">
                          </div>

                        </div>
                       
                      </form>
        
    

        <table id="orderTable" class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Invoice</th>
                <th scope="col">Purchaser</th>
                <th scope="col">Distributor</th>
                <th scope="col">Referred Distributors</th>
                <th scope="col">Order Date</th>
                <th scope="col">Order Total</th>
                <th scope="col">Percentage</th>
                <th scope="col">Commission</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    
                <tr>
                    <th scope="row">{{ $user->invoice_number }}</th>
                    <td> {{ $user->user->fullname }} </td>
                    <td>{{ getDistributor($user->user->referred_by) }}</td>
                    <td>{{ getTotalDistributorCount( $user->user->referred_by)  }}</td>
                    <td>{{ $user->order_date }}</td>
                    <td>{{ $user->product[0]->price * $user->product[0]->pivot->qantity }}</td>
                    <td>{{ getPercentage($user->user->referred_by) }}% </td>
                    <td class="commission">
                      <?php 
                         $percentage = getPercentage($user->user->referred_by);
                        $totalOrder = $user->product[0]->price * $user->product[0]->pivot->qantity;

                          echo number_format(($percentage / 100) * $totalOrder, 2);
                        ?>

                    </td>
                    <td><a href="#"  class="btn btn-success currentItem" currentItem="{{ $user->purchaser_id }}">View Items</a></td>
                </tr>
                @endforeach
             
            </tbody>
          </table>
          {{ $users->links('paginate') }}
          <a href="{{ route('top') }}" class="ml-0 mr-0">CHECK OUT THE TOP 100 Distributor</a>
    </div>


</fieldset>

        <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.js') }}"></script>

     

<script>

$( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: "{{ route('autocomplete') }}",
            type: 'GET',
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
            //  console.log(data)
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
        //   console.log(ui.item); 
           return false;
        }
      });

$('.currentItem').click(function(){

  let id = $(this).attr('currentItem');

                $.ajax({
                    url: "{{ route('fetch') }}",
                    data: {
                        id: id
                    },
                    type: "POST",
                    
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        swal.fire({
                          width: 600,
                        html: `<div class="table-responsive">
                        <table class="table">
                          <thead>
                          <tr>
                            <th scope="col">SKU</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                          <tbody>
                            ${result}
                          </tbody>
                        </table>
                      </div>`
                      })

                    },
                    error: function() {
                        console.log('error');
                    }
                });

});
calc_total();

function calc_total(){
  var sum = 0;
  $(".commission").each(function(){
    sum += parseFloat($(this).text());
  });
  $('#sum').text(sum.toFixed(2));
}

$("#inputSearch").on("keyup",function(){
        value = $(this).val().toLowerCase();
        $("#orderTable tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        })

    })

</script>

</body>
</html>