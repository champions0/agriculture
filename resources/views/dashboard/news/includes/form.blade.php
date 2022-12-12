<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Վերնագիր</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') ?? ($news->title ?? '' )}}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Գլխավոր նկար</label>
                <input type="file" class="form-control" name="wallpaper">
                @error('wallpaper')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Նկարներ</label>
                <input type="file" multiple class="form-control" name="images[]">
                @error('images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Ավելացման ամսաթիվ</label>
                <input type="datetime-local" class="form-control " name="news_date"
                       value="{{ old('news_date') ? str_replace(' ', 'T', old('news_date')) : (isset($news) ? str_replace(' ', 'T', $news->news_date) : '') }}">
                @error('news_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Նկարագրություն</label>
                <textarea name="description" class="form-control">{{ old('description') ?? ($news->description ?? '') }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Կարգավիճակ</label>
                <select class="form-control" name="status">
                    <option {{ old('status') == \App\Models\News::INACTIVE ? 'selected' : (isset($news) && $news->status == \App\Models\News::INACTIVE ? 'selected' : '') }} value="{{ \App\Models\News::INACTIVE }}">Ոչ ակտիվ</option>
                    <option {{ old('status') == \App\Models\News::ACTIVE ? 'selected' : (isset($news) && $news->status == \App\Models\News::ACTIVE ? 'selected' : '') }} value="{{ \App\Models\News::ACTIVE }}">Ակտիվ</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
