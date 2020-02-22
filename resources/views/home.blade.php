@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="alk-table" class="table ">
                        <thead><tr><th>Id</th><th>Full name</th><th>Details</th></tr></thead>
                        <tbody></tbody>
                      </table>

                     <span id="PreeValue" class="page-link col-md-2" > << Pre</span> <span id="nextValue" class="page-link col-md-2" >next >></span><br>

                    </div>
            </div>
        </div>
    </div>
</div>


<script>
    var currrent_page =1;
$(document).ready(function() {
     ajaxcall(1);
} );
function ajaxcall(pageNumber)
    {
        $('table#alk-table tbody').empty();
        $.ajax({
            url: "https://reqres.in/api/users?page="+pageNumber,
            data: {},
            beforeSend: function(){}
            }).done(function(response) {
            var trArr = new Array();
            currrent_page =response.page;
            console.log(response)
            console.log(currrent_page)

            if(currrent_page == 1)
            {innerHtml="";
                $("#PreeValue").addClass('d-none');

            }
            else
            {
                $("#PreeValue").removeClass('d-none');

            }

            if(response.page * response.per_page  >= response.total)
            {
                $("#nextValue").addClass('d-none');

            }
            else
            {
                $("#nextValue").removeClass('d-none');

            }
            $.each(response.data, function(i, v){
                trArr.push('<tr><td>' + v.id + '</td><td onClick="getUserDetails('+v.id+')">' + v.first_name+ "  "+ v.last_name + '</td><td id="details-'+v.id+'">   </td></tr>');//<td>' + v.last_name + '</td><td><img src="' + v.avatar + '" width="120px" /></td></tr>');
            });
            $('table#alk-table tbody').append(trArr.join('\n'));
        });
    }





    $('#nextValue').click(function(){

        ajaxcall(currrent_page+1);

    //Some code
});
$('#PreeValue').click(function(){

ajaxcall(currrent_page-1);

//Some code
});

$('.table').on('click', '.web_id', function(e) {
    e.preventDefault();

    // You can put here the logic of the 'showMoreData()' function
    alert( $(this).data('index') );
});

function getUserDetails(userId)
    {
        $.ajax({
            url: "https://reqres.in/api/users/"+userId,
            data: {},
            beforeSend: function(){}
            }).done(function(response) {
            var trArr = new Array();
            console.log(response)

            var id = '#details-'+userId;
            console.log(id);
            var derails = '<div class="col-md-12"> First Name : ' + response.data.first_name + '</div><div class="col-md-12"> Last Name : ' + response.data.last_name + '</div><div class="col-md-12">Email :' + response.data.email + '</div><div class="col-md-12"><img src="' + response.data.avatar + '" width="120px" /></div>';
            $(id).html(derails);
        });
    }
</script>
@endsection
