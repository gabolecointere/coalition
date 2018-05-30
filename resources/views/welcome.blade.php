<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Styles -->
    </head>
    <body>
      <div class="container">
        <form class="" action="{{ url('/items') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" placeholder="Enter Product Name" required>
          </div>
          <div class="form-group">
            <label for="quantityInStock">Quantity in Stock</label>
            <input type="number" class="form-control" id="quantityInStock" placeholder="Enter Quantity in Stock" required>
          </div>
          <div class="form-group">
            <label for="pricePerItem">Price per Item</label>
            <input type="number" class="form-control" id="pricePerItem" placeholder="Enter Price per Item" required>
          </div>
          <button type="submit" class="btn btn-default" id="submitItem" onClick="submitItem">Submit</button>
        </form>
      </div>
      <br><br>
      <div class="container">
        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <td>Product Name</td>
              <td>Quantity in Stock</td>
              <td>Price per Item</td>
              <td>Datetime submitted</td>
              <td>Total value number</td>
            </tr>
          </thead>
          @if(isset($items))
          <?php  $totalqty = 0  ?>
          <?php  $totalprice = 0  ?>
          <?php  $totalproduct = 0  ?>
          <tbody>
            @foreach ($items as $item)
            <?php  $ditem = json_decode($item, true)  ?>
              <tr>
                <td>{{ $ditem['name'] }}</td>
                <td>{{ $ditem['qty'] }}</td>
                <td>{{ $ditem['price'] }}</td>
                <td>{{ $ditem['date'] }}</td>
                <td>{{ $ditem['qty']*$ditem['price'] }}</td>
              </tr>
              <?php  $totalqty += $ditem['qty']  ?>
              <?php  $totalprice += $ditem['price']  ?>
              <?php  $totalproduct += $ditem['qty']*$ditem['price']  ?>
            @endforeach
            <tr>
              <td></td>
              <td id="totalqty">{{ $totalqty }}</td>
              <td id="totalprice">{{ $totalprice }}</td>
              <td></td>
              <td id="totalproduct">{{ $totalproduct }}</td>
            </tr>
          </tbody>
          @endif
        </table>
      </div>

      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
