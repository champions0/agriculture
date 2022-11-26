<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Վերնագիր</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') ?? ($statement->title ?? '' )}}">
                @error('title')
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
                <label>Հայտարարողի անուն</label>
                <input type="text" class="form-control" name="declarant_first_name" value="{{ old('declarant_first_name') ?? ($statement->declarant_first_name ?? '' )}}">
                @error('declarant_first_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Հայտարարողի ազգանուն</label>
                <input type="text" class="form-control" name="declarant_last_name" value="{{ old('declarant_last_name') ?? ($statement->declarant_last_name ?? '')}}">
                @error('declarant_last_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Ավելացման ամսաթիվ</label>
                <input type="datetime-local" class="form-control " name="statement_date"
                       value="{{ old('statement_date') ? str_replace(' ', 'T', old('statement_date')) : (isset($statement) ? str_replace(' ', 'T', $statement->statement_date) : '') }}">
                @error('statement_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Ավարտի ամսաթիվ</label>
                <input type="datetime-local" class="form-control " name="deadline"
                       value="{{ old('deadline') ? str_replace(' ', 'T', old('deadline')) : (isset($statement) ? str_replace(' ', 'T', $statement->deadline) : '') }}">
                @error('deadline')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Կարճ նկարագրություն</label>
                <textarea name="description" class="form-control">{{ old('description') ?? ($statement->description ?? '') }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Կարգավիճակ</label>
                <select class="form-control" name="status">
                    <option {{ old('status') == \App\Models\Statement::INACTIVE ? 'selected' : (isset($statement) && $statement->status == \App\Models\Statement::INACTIVE ? 'selected' : '') }} value="{{ \App\Models\Statement::INACTIVE }}">Ոչ ակտիվ</option>
                    <option {{ old('status') == \App\Models\Statement::ACTIVE ? 'selected' : (isset($statement) && $statement->status == \App\Models\Statement::ACTIVE ? 'selected' : '') }} value="{{ \App\Models\Statement::ACTIVE }}">Ակտիվ</option>
                    <option {{ old('status') == \App\Models\Statement::CANCELED ? 'selected' : (isset($statement) && $statement->status == \App\Models\Statement::CANCELED ? 'selected' : '') }} value="{{ \App\Models\Statement::CANCELED }}">Ավարտված</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
