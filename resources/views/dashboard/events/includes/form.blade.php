<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') ?? ($event->title ?? '' )}}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Թեմա</label>
                <select class="form-control" name="subject">
                    @foreach ($subjects as $key => $subject)
                        <option {{ old('subject') == $key ? 'selected' : (isset($event) && $event->subject_id == $key ? 'selected' : '') }} value="{{ $key }}">{{ $subject }}</option>
                    @endforeach
                </select>
                @error('subject')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Նկար</label>
                <input type="file" class="form-control" name="wallpaper">
                @error('wallpaper')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Տարիքային սահման</label>
                <input type="text" class="form-control" name="age" value="{{ old('age') ?? ($event->age ?? '' )}}">
                @error('age')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Կազմակերպիչ</label>
                <input type="text" class="form-control" name="organizer" value="{{ old('organizer') ?? ($event->organizer ?? '' )}}">
                @error('organizer')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Սկիզբ</label>
                <input type="datetime-local" class="form-control " name="start_date"
                       value="{{ old('start_date') ? str_replace(' ', 'T', old('start_date')) : (isset($event) ? str_replace(' ', 'T', $event->start_date) : '') }}">
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Ավարտ</label>
                <input type="datetime-local" class="form-control " name="end_date"
                       value="{{ old('end_date') ? str_replace(' ', 'T', old('end_date')) : (isset($event) ? str_replace(' ', 'T', $event->end_date) : '') }}">
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Հասցե</label>
                <input type="text" class="form-control" name="address" value="{{ old('address') ?? ($event->address ?? '' )}}">
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Կարճ նկարագրություն</label>
                <textarea name="short_description" class="form-control"></textarea>
                @error('short_description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Այլ տեղեկություններ</label>
                <textarea name="additional_info" class="form-control"></textarea>
                @error('additional_info')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Սեռ</label><br>
                <label for="male">Արական
                    <input type="radio" id="male" value="male" name="gender" {{ old('gender') == 'male'  ? 'checked' : (isset($event) && $event->gender == 'male' ? 'checked' : '') }}">
                </label>
                <label for="female">Իգական
                    <input type="radio" id="female" value="female" name="gender" {{ old('gender') == 'male'  ? 'checked' : (isset($event) && $event->gender == 'male' ? 'checked' : '') }}">
                </label>
                <label for="all">Բոլորը
                    <input type="radio" id="all" value="all" name="gender" {{ old('gender') == 'male'  ? 'checked' : (isset($event) && $event->gender == 'male' ? 'checked' : '') }}">
                </label>
                @error('gender')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
