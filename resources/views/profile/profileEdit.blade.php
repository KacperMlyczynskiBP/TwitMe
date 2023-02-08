<x-profileMaster>
    @section('edit')
        <form method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data">
        <div class="form">
            @csrf
            <div class="form-container">
                <div class="input-container ic1">
                    <a href="#" id="profile-link" >
                            <div class="profile-picture">
                                <img src="{{asset($user->user_image_path)}}" width="133px" height="133px">
                            </div>
                    </a>
                    <div class="media">
                        <label for="file-upload" class="custom-file-upload">
                            <img class="custom-file-upload" src="{{asset('images/R.jpg')}}"
                                 height="20px" width="20px">
                            <input type="file" name="tweetMedia" class="custom-file-upload">
                        </label>
                    </div><br>
                   <a href="{{ route('delete.picture') }}">X</a>
                </div> <br><br>
                <div class="input-container ic1">
                    <input class="input" name="username" type="text" value="{{$user->username}}" placeholder=" " />
                    <label for="Username" class="placeholder">Username</label>
                </div>
                <div class="input-container ic1">
                    <input class="input" name="bio" type="text" placeholder=" " />
                    <label for="Bio" class="placeholder">Bio</label>
                </div>
                <div class="input-container ic1">
                    <input class="input" name="location" type="text" placeholder=" " />
                    <label for="Location" class="placeholder">Location</label>
                </div>
                <div class="input-container ic1">
                    <input type="date" class="input" value="{{$user->date_of_birth}}" style="float: bottom" name="date_of_birth" placeholder=""><br>
                    <label for="BirthdayDate" class="placeholder">Birthday Date - {{$user->date_of_birth}}</label>
                </div>
                <input type="submit"  class="sidebar__tweet" name="submit">
            </div>
        </div>
        </form>
    @endsection
</x-profileMaster>
