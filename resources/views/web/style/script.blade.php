<script>
    $('.add_cart').click(function(){
        var product_id=$(this).attr('product_id');
        // console.log(product_id)
        $.ajax({
            url:"{{ route('web/dataCart') }}",
            method:"post",
            data:{product_id:product_id ,_token:"{{ csrf_token() }}"},
            success:function(data){

                // ----------------load
                $(".shopping-list").load(location.href+" .shopping-list",function(){
                        var num_items=$(".item_pro").length;
                        var price=document.querySelectorAll(".price_pro");
                        var count=document.querySelectorAll(".count_pro");
                        var total=0;
                        for (var i = 0; i < price.length; i++) {
                            var total = total+ +price[i].innerHTML*count[i].innerHTML;
                        }
                        $(".total-amount").html(total+"$");
                        $(".num_items").html(num_items+" Items");
                        $(".total_cart").html(num_items);

                    $(".del_pro").click(function(){
                        $(this).closest(".item_pro").remove();
                        var product_id=$(this).attr("del_pro");
                        // console.log(product_id)
                        var num_items=$(".item_pro").length;


                        var price=document.querySelectorAll(".price_pro");
                        var count=document.querySelectorAll(".count_pro");

                        var total=0;

                        for (var i = 0; i < price.length; i++) {
                            var total = total+ +price[i].innerHTML*count[i].innerHTML;

                        }

                        $(".total-amount").html(total+"$");
                        $(".num_items").html(num_items+" Items");
                        $(".total_cart").html(num_items);

                    })
                })

                // ----------------endload
                console.log(data);
            },
            error:function (error) {

                console.log(error);
            }
        });
    });
</script>

<script>
    $(".del_pro").click(function(){
        $(this).closest(".item_pro").remove();
        var product_id=$(this).attr("del_pro");
        // console.log(product_id)
        var num_items=$(".item_pro").length;


        var price=document.querySelectorAll(".price_pro");
        var count=document.querySelectorAll(".count_pro");

        var total=0;

        for (var i = 0; i < price.length; i++) {
            var total = total+ +price[i].innerHTML*count[i].innerHTML;

        }

        $(".total-amount").html(total+"$");
        $(".num_items").html(num_items+" Items");
        $(".total_cart").html(num_items);


        $.ajax({
            url:"{{ route('web/remove') }}",
            method:"post",
            data:{product_id:product_id ,_token:"{{ csrf_token() }}"},
            success:function(data){console.log(data)},
            error:function(error){console.log(error)}
        })





    })




</script>

<script>

    $("._search").keyup(function(){
        var search=$(this).val();
        // console.log(search);

        $.ajax({
            url:"{{ route('web/search') }}",
            method:"get",
            data:{search:search ,_token:"{{ csrf_token() }}"},
            success:function(data){

                $(".find").html(data);

                console.log(data)},
            error:function(error){console.log(error)}
        })
    })
</script>



