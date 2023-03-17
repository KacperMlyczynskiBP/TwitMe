<x-indexMaster>
   @section('explore')

    <div class="feed__header">
        <h2>Explore</h2>
    </div>

    <div class="sports-results">
        <div class="sports-results-header">
            <h2>Latest Sports Results</h2>
        </div>
        <div class="sports-results-body">
            <ul>
                @foreach($results as $result)
                <li>
                    <div class="sports-result-item">
                        <div class="sports-result-info">
                            <h3>{{$result['league']['name']}}</h3>
                            <p>{{$result['teams']['home']['name']}} {{$result['scores']['home']['total']}} - {{$result['scores']['away']['total']}}  {{$result['teams']['away']['name']}}</p>
                        </div>
                        <div class="sports-result-date">

                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    @endsection

</x-indexMaster>x
