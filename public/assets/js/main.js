$('#submitItem').click(function(e) {
  e.preventDefault()

  var errors = [];
  var name = $('#productName').val() !== '' ? $('#productName').val() : errors.push('Product Name Field cannot be empty')
  var qty = ($('#quantityInStock').val() !== '' && parseInt($('#quantityInStock').val()) > 0) ? $('#quantityInStock').val() : errors.push('Quantity in Stock Field cannot be empty and has to be a positive integer')
  var price = ($('#pricePerItem').val() !== '' && parseFloat($('#pricePerItem').val()) > 0) ? $('#pricePerItem').val() : errors.push('Price per Item cannot be empty and has to be a positive number')

  if (errors.length) {
    var errorMsg = '';
    errors.forEach(function(msg) {
      errorMsg += msg + '\n'
    })

    alert(errorMsg)
    return false
  }

  data = {
    _token: $('meta[name="csrf-token"]').attr('content'),
    name: name,
    qty: qty,
    price: price
  }

  $.post('/items', data, function(response) {
    $('#myTable tr:last').before('<tr><td>' + response.name +'</td><td>' + response.qty + '</td><td>' + response.price + '</td><td>' + response.date  + '</td><td>' + response.price*response.qty + '</td></tr>')

    var newtotalqty = parseInt($('#totalqty').text()) + parseInt(response.qty)
    var newtotalprice = parseInt($('#totalprice').text()) + parseInt(response.price)
    var newtotalproduct = parseInt($('#totalproduct').text()) + (response.price*response.qty)

    $('#totalqty').text(newtotalqty);
    $('#totalprice').text(newtotalprice);
    $('#totalproduct').text(newtotalproduct);

    //console.log(parseInt($('#totalqty').text()) + parseInt(response.qty), parseInt($('#totalprice').text()) + parseInt(response.price), parseInt($('#totalproduct').text()) + (response.price*response.qty) )
  })
})
