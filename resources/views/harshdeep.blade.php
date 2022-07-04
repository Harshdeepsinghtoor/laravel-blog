<h1>This is Harshdeep Singh Page</h1>
<h2>{{$name}}</h2>
<h3>{{date('d-m-y')}}</h3>
{!!'<h1>Hello World</h1>'!!}
@if ($name!="Unknown Names")
    {{"Name is not empty"}}
    
@endif
@for ($i = 1; $i <=10; $i++)
    <h1>{{$i}}</h1>
@endfor