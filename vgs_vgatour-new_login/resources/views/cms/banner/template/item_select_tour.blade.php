<div class="item-upload">
    <div class="widget-upload">
        <div class="icon-upload"></div>
        <div class="header-upload">
            <span class="title-upload">{{$title_upload}}</span>
        </div>
        <div class="body-upload">
            <div class="content-upload">

                @foreach($listTour as $tour)

                    @if($tour->$name == 1)

                        <div class="name-image view-upload">
                            <p class="name-image-upload">{{$tour->name}}</p>
                            <p class="upload-by">Người thêm: Châu Hương - ngày 12/12/2021</p>
                        </div>

                        <div class="view-upload">
                            <select name="{{$name}}" class="form-control select-tour" style="width: 300px;">
                                <option value="">Chọn giải</option>
                            </select>
                        </div>
                        {{--                        <div class="view-upload">--}}
                        {{--                            <label class="switch">--}}
                        {{--                                <input type="checkbox" checked>--}}
                        {{--                                <span class="slider round"></span>--}}
                        {{--                            </label>--}}
                        {{--                        </div>--}}
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <button class="btn btn-primary btn-add-banner"> + Thêm</button>
</div>

<script>
    $(document).ready(function () {

        var searchTour = '{{route('searchTour')}}';

        $('.select-tour').select2({
            language: "vi",
            allowClear: true,
            minimumInputLength: 2,
            placeholder: 'Chọn giải',
            ajax: {
                url: searchTour,
                dataType: 'json',
                type: "GET",
                quietMillis: 500,
                data: function (key) {
                    return {
                        keyword: key
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    });
</script>
