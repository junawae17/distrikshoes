<style type="text/css">
  .form-control {
    display: block;
    width: 39%;
  }
</style>
<div class="container">
    <section class="product-card">
    <div class="row">
      <div class="col-sm-5">
        <div class="product-card__slider" id="image-block">
          <div class="slider-product flexslider">
          <ul class="slides">
            <?php $rows_images = explode(",",$row['images_product']);
              for ($a=0; $a < count($rows_images)  ; $a++) { ?>
            <li> <img src="<?=base_url().'assets/uploads/product/'.$rows_images[0]?>" width="350" title="Foto" alt="<?=$row['product_name']?>"></li>
            <?php }?>
          </ul>

        </div>
        <div class="carousel-product flexslider">
        <ul class="slides">
          <?php for ($i=0; $i < count($rows_images)  ; $i++) { ?>
            <li><a href="<?=base_url().'assets/uploads/product/'.$rows_images[$i]?>"  class="prettyPhoto"><img src="<?=base_url().'assets/uploads/product/'.$rows_images[$i]?>" height="100" width="100"  alt="<?=$row['product_name']?>"> </a> </li>
            <?php }?>
        </ul>
      </div>
      <br>
       <span><a href="<?=base_url().'downloadimage/'.$this->uri->segment(2)?>" target="_blank">Download all pic</a></span>
    </div>
    <!-- end product-card__slider --> 
  </div>
  <div class="col-sm-7">
    <div class="product-card__main">
      <h1 class="product-card__name"><?=$row['product_name']?></h1>
      <div class="product-card__availability"><i class="icon fa fa-check-circle"></i>Tersedia</div>
      <div class="product-card__price"> <span class="product-card__price-new"><?=currency($row['price'])?></span> </div>
      <div class="product-card__description">
        <?=$row['information']?>
      </div>
      <footer class="card-btns">
        <label class=" control-label">Pilih Size :</label>
          
        <form action="<?=base_url().'masukKeranjang/'.$this->uri->segment(2)?>" method="post">
        <div class="">
            <?php //$size = $this->M__db->get_select('msize__','id_size,nama_size')->result();
                  $size = $this->db->query("SELECT *  FROM datastock__ left join msize__ on msize__.id_size = datastock__.id_size where product_id = ".$row['product_id']." and status_stock = 1  GROUP BY datastock__.id_size;")->result();
            ?>
            <select class="form-control" required name="size_idd" id="size_id">
             <option value="0">Pilih Size</option>
              <?php foreach ($size as $dt) { ?>
                <option value="<?=$dt->id_size;?>"><?=$dt->nama_size;?></option>
              <?php } ?>
            </select>
          </div>
          <input type="hidden" name="" id="stok" value="<?=$row['stock'] ?>">
          <input type="hidden" name="" id="product_id" value="<?=$row['product_id'] ?>">
        <div class="enumerator"> <a class="minus_btnn card-btns__btn"><i class="icon fa fa-minus"></i></a>
          <input type="text" id="jumlah" name="jumlah" placeholder="1" value='0'>
          <a class="plus_btnn card-btns__btn"><i class="icon fa fa-plus"></i></a> </div>
          <button type='submit' class="card-btns__add"><i class="icon fa fa-shopping-cart"></i> Beli</button>
          </form>
      </footer>
      
    </div>
  </div>
</div>
</section>
</div>

<script>
    // $(document).ready(function(){

        // $("#size_id").change(function(){
        //  var id_size=$('#size_id').val();
        //  var product_id=$('#product_id').val();
         
        //     $.ajax({
        //         url:"<?php echo site_url('getstock')?>",
        //         type:"POST",
        //         cache:false,
        //         data:"id_size="+id_size,
        //         success:function(data){
        //              $('#stok').value('2');
        //         }
        //     });
                
        // });
    // });
</script>

<script>
    $(document).ready(function(){

      $(".minus_btnn").on('click', function() {
        var inputEl = jQuery(this).parent().children().next();
        var qty = inputEl.val();
        // console.log(qty)
        if (jQuery(this).parent().hasClass("minus_btn"))
            qty++;
        else
            qty--;
        if (qty < 0)
            qty = 0;
        inputEl.val(qty);
    })


      $("#size_id").change(function(){
         var id_size=$('#size_id').val();
         var product_id=$('#product_id').val();
         
            $.ajax({
               url:"<?=base_url()?>PublicCTRL/getstock",
                data:{id_size:id_size, product_id:product_id},
                // url:"<?php //echo site_url('getstock')?>",
                type:"POST",
                cache:false,
                // data:"id_size="+id_size,
                success:function(data){
                     $('#stok').val(data);
                      $('#jumlah').val(data);
                }
            });
                
        });



    $(".plus_btnn").on('click', function() {
        var inputEl = jQuery(this).parent().children().next();
        var qty = inputEl.val();
        var stock = $('#stok').val();
        console.log(qty)
        
        if (stock == 0) {
          qty = 0;
          $.growl.warning({ message: 'Maaf size yang ada pilih sedang kosong', duration:5000 });
          // alert("Sory Stock size 42 kosong ")
        }else{
          if (jQuery(this).hasClass("plus_btn"))
            qty++;
         
          else
              qty--;
          if (qty < 0)
              qty = 0;

          if  (qty++ == stock - 1 )
                qty = stock;
          else
                qty++;
        }

        

        inputEl.val(qty);
    })

       
    });
</script>