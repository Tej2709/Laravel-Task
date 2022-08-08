
<script>

$(document).ready(function (){

   $('#daily_works_filter').change(function (){

       var work =$($this).val();

       $.ajax({

           url:"{{ url('filterworks')}}",
           type:"GET",
           data:{'Daily_works' : work},

           success:function(user)
           {
               var users = user;
                
               var html = '';

               if(users.length > 0)    
               {
                   for(let i = 0; i < users.length; i++)
                   {
                       html +='<tr>\
                       <td>'+(i+1)+'</td>\
                       <td>'+users[i]['name']+'</td>\
                       <td>'+users[i]['email']+'</td>\
                       <td> <img src="public/images/'+users[i]['image']+'"width="100" height="80"> </td>\
                       <td>'+users[i]['gender']+'</td>\
                       <td>'+users[i]['age']+'</td>\
                       <td>'+users[i]['daily__works_id']+'</td>\
                       </tr>';
                   }
               }

               else{
                   html +='<tr>\
                   <td>No User Found</td>\
                   </tr>';
               }
               $("#tbody").html(html);
           }

       });

   });

});

</script>




public function filterworks(Request $request)
    {
        $query = User::query();
        $works = Daily_Works::all();

        if ($request->ajax()) {
            if (empty($request->Daily_Works)) {
                $user =  $query->get();
            } else {
                $user = $query->where(['daily__works_id' => $request->Daily_Works])->get();
            }
            return response()->json($user);
        }
    }






    
    if (auth()->user()->usertype == '1') {

$works = Daily_Works::all();
$user = User::with('daily_works')->where('usertype', '0')
    ->orwhere('approve', 'false')
    ->sortable()->paginate(2);
return view('users.index', compact('user','works'))
    ->with('i', (request()->input('page', 1) - 1) * 2);
} elseif (auth()->user()->usertype == '0') {


if (auth()->user()->approve == 'false') {
    $works = Daily_Works::all();
    $user = User::with('daily_works')->where('id', auth()->user()->id)
        ->where('status', 'active')
        ->sortable()->paginate(2);
    return view('users.index', compact('user','works'))
        ->with('i', (request()->input('page', 1) - 1) * 2);
} else {
$works = Daily_Works::all();
 
    $user = User::with('daily_works')->where('usertype', '0')
        ->where('status', 'active')
        ->where('approve', 'true')
        ->sortable()->paginate(2);
    return view('users.index', compact('user','works'))->with('i', (request()->input('page', 1) - 1) * 2);
}
}





if (auth()->user()->usertype =='1') {

$works = Daily_Works::all();
$filter = $request->filter;


if (empty($filter)) {
    $works = Daily_Works::all();
    $user = User::with('daily_works')->where('usertype', '1')->sortable()->paginate(2);
} 
else 
{
    $user = User::with('daily_works')->whereHas('daily_works',function($user) use ($filter) 
    {   
    $user->where('daily__works_id',$filter);
    })->sortable()->paginate(5);
}
return view('users.index', compact('user', 'works'))->with('i', (request()->input('page', 1) - 1) *2);
}
