@extends('layouts.app')
@section('content')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="container">    
</head>
<div class="container">
<div class="row" style="margin-top: 5rem;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Product</h2>
        </div>
        <select id="category_id" name="cat_id">
                <option value="">All</option>
                        @foreach($data1 as $value)
                            <option value="{{ $value->cname}}">{{ $value->cname}}</option>
                        @endforeach
                </select>

    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<br>

<table class="table table-hover">

<tr class="table-success">
        <th>No</th>
        <th>Product</th>
        <th>Category</th>
        <th>Image</th>
        <th>Created By</th>
        <th>Active</th>
    </tr>
    <tbody id="tbody">

    @foreach($data as $key => $value)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $value->pname }}</td>
        <td>{{ $value->catid }}</td>

        <td><img src=" {{ asset('public/images/' . $value->image)}}" width="100" height="80"></td>
        <td>{{ $value->email}}</td>
        <td>{{ $value->active}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
<script>
        $(document).ready(function(){
           

            $('#category_id').change(function(){
               
                var category = $(this).val();
                
               
                $.ajax({
                    url:"{{ url('filterProduct') }}",
                    type:"GET",
                    data:{'category' : category},
                    success: function(data){
                        
                        var products = data;
                        
                        var html = '';
                        if(products.length > 0) {
                            for(let i = 0; i < products.length; i++){
                                html +='<tr>\
                                        <td>'+(i+1)+'</td>\
                                        <td>'+products[i]['pname']+'</td>\
                                        <td>'+products[i]['catid']+'</td>\
                                        <td> <img src="public/images/'+products[i]['image']+'"width="100" height="80"> </td>\
                                        <td>'+products[i]['createby']+'</td>\
                                        <td>'+products[i]['active']+'</td>\
                                        </tr>';
                            }
                        }
                        else{
                            html +='<tr>\
                                    <td>No Products Found</td>\
                                    </tr>';
                        }
                        $("#tbody").html(html);
                    }
                });
            });
        });
    </script>

</div>
@endsection