<x-adminMaster>
    @section('createTable')


        <form method="POST" action="{{ route('createTable') }}">
            @csrf
            <label>
                <h1>Liczba osob</h1>
                <select name="people_number">

                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>

                </select>
            </label>
            <input type="submit" name="submit">

        </form>

    @endsection

</x-adminMaster>
