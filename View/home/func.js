$(document).ready(function(){
    $('#search').keyup(function(){
        var search = $(this).val();
        //trim retire tout le espace du début
        search = $.trim(search);

        if(search!==""){
            $.post('post.php',{search:search},function(data){
                $("#result ul").html(data);
            });
        }

    });
});