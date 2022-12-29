<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Վերնագիր</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') ?? ($notification->title ?? '' )}}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Նկարագրություն</label>
                <textarea name="description" class="form-control">{{ $notification->description ?? '' }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Տեսակ</label>
                <select class="form-control" name="status">
                    <option {{ old('status') == \App\Models\Notification::UNREAD ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::UNREAD ? 'selected' : '') }} value="{{ \App\Models\Notification::UNREAD }}">Չկարդացված</option>
                    <option {{ old('status') == \App\Models\Notification::READ ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::READ ? 'selected' : '') }} value="{{ \App\Models\Notification::READ }}">Կարդացված</option>
                    <option {{ old('status') == \App\Models\Notification::OPENED ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::OPENED ? 'selected' : '') }} value="{{ \App\Models\Notification::OPENED }}">Բացված</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Կարգավիճակ</label>
                <select class="form-control" name="status">
                    <option {{ old('status') == \App\Models\Notification::UNREAD ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::UNREAD ? 'selected' : '') }} value="{{ \App\Models\Notification::UNREAD }}">Չկարդացված</option>
                    <option {{ old('status') == \App\Models\Notification::READ ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::READ ? 'selected' : '') }} value="{{ \App\Models\Notification::READ }}">Կարդացված</option>
                    <option {{ old('status') == \App\Models\Notification::OPENED ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::OPENED ? 'selected' : '') }} value="{{ \App\Models\Notification::OPENED }}">Բացված</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>
