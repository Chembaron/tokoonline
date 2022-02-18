function qty(obj) {
    var kuantitas = $(obj).val();
    var id = $(obj).attr("id");
    $.post("setQty.php",{kuantitas:kuantitas,id:id}).done(function(data){
      var hasil = JSON.parse(data);
      if (hasil.status == 'batas') {
        swal("Stok melebihi batas","","warning");
        $(obj).val('1');
      }else if (kuantitas == '0') {
        swal("Minimal membeli 1","","warning");
        $(obj).val('1');
      }else if (kuantitas < '0') {
        swal("Minimal membeli 1","","warning");
        $(obj).val('1');
      }else {
        $('#cartList').load('cart.php' + ' #cartList');
      }
    });
  }