$(document).ready(function(){
    $('#search').keyup(function(){
        var search = $(this).val();
        //trim retire tout le espace du début et de la fin
        search = $.trim(search);

        if(search!==""){
            $.post('index.php?controller=company&action=searchBar&api=1',{search:search},function(data){
                $("#result ul").html(data);
            });
        }

    });
});