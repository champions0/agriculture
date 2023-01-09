<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Օգտատիրոջ ՀՎՀՀ</label>
                <input type="text" class="form-control" name="number" value="{{ old('number') ?? ($notification->number ?? '' )}}">
            </div>
        </div>
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
                <textarea name="description" class="form-control" id="editor">{{ $notification->description ?? '' }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

{{--        <div class="col-md-3">--}}
{{--            <div class="form-group">--}}
{{--                <label>Կարգավիճակ</label>--}}
{{--                <select class="form-control" name="status">--}}
{{--                    <option {{ old('status') == \App\Models\Notification::UNREAD ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::UNREAD ? 'selected' : '') }} value="{{ \App\Models\Notification::UNREAD }}">Չկարդացված</option>--}}
{{--                    <option {{ old('status') == \App\Models\Notification::READ ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::READ ? 'selected' : '') }} value="{{ \App\Models\Notification::READ }}">Կարդացված</option>--}}
{{--                    <option {{ old('status') == \App\Models\Notification::OPENED ? 'selected' : (isset($notification) && $notification->status == \App\Models\Notification::OPENED ? 'selected' : '') }} value="{{ \App\Models\Notification::OPENED }}">Բացված</option>--}}
{{--                </select>--}}
{{--                @error('status')--}}
{{--                <div class="text-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-3">
            <div class="form-group">
                <label>Տեսակ</label>
                <select class="form-control" name="type">
                    <option {{ old('type') == \App\Models\Notification::OTHER ? 'selected' : (isset($notification) && $notification->type == \App\Models\Notification::OTHER ? 'selected' : '') }} value="{{ \App\Models\Notification::OTHER }}">Այլ</option>
                    <option {{ old('type') == \App\Models\Notification::TAX ? 'selected' : (isset($notification) && $notification->type == \App\Models\Notification::TAX ? 'selected' : '') }} value="{{ \App\Models\Notification::TAX }}">Հարկային</option>
                </select>
                @error('type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>

@error('number')
    <!-- Button to Open the Modal -->
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#myModal').modal('show');
        });
    </script>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            {{-- <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> --}}

            <!-- Modal body -->
            <div class="modal-body">
                Ձեր նշված տվյալներով օգտատեր չի գտնվել ինֆորմա հարթակում։ Խնդրում ենք ստուգել տվյալները կամ կապ հաստատել քաղաքացու հետ այլ տեղեկատվության փոխանակման միջոցներով։ Քաղաքացին հնարավոր է չունի օգտահաշիվ informa հարթակում։
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Փակել</button>
            </div>

            </div>
        </div>
    </div>
@enderror
