<x-master>

    @include('navbar')
    @section('menu')

        <div clas="menu-container">

            <img height="400px" width="100%" src="/images/jay-wennington-N_Y88TWmGwA-unsplash.jpg" alt="" class="">


              @foreach($socialShare as $key=>$value)
{{--                <div class="social"><a href="{{$value}}">{{$key}}</a></div>--}}
                <div class="socialPictureTwitter">
                    <a href="{{$value}}">{{$key}}</a>
                </div>
            @endforeach


<ul>
 @foreach($dishType as $dishT)
<li><a href="/menu/{{$dishT->name}}">{{$dishT->name}}</a></li>
@endforeach
</ul>



<div class="dishes">
    @foreach($dishes->where('dish_id', $soupId) as $dish)
    <form method="POST" action="{{ route('add.to.cart') }}">
        @csrf
  <div class="dish" style="">
    <div>{{$dish->name}}</div><br/>
    <div class="weight">{{$dish->weight}}</div><br/>
    <div>{{$dish->body}}</div>
{{--     <a href="{{ route('add.to.cart') }}" class="button">Buy Me--}}
{{--     </a>--}}
      <div>Discount</div>
      <input type="hidden" name="product_id" value="{{$dish->id}}">
      <button type="submit" name="submit">{{$dish->price}}</button>
{{--      <a href="{{ route('add.to.cart') }}">{{$dish->price}}</a>--}}
      {{--      <input type="submit" name="submit">--}}
  </div>                      <br/>
    </form>
    @endforeach
</div>
</div>
@endsection
</x-master>










{{--kontrola jakosci czesci samochodowych --}}
